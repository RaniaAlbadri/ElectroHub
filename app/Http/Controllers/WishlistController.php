<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WishlistController extends Controller
{
    // User's saved products
    public function index(Request $request): View
    {
        $wishlists = Wishlist::query()
            ->where('user_id', $request->user()->id)
            ->with('product.category')
            ->latest()
            ->paginate(12);

        return view('wishlist.index', compact('wishlists'));
    }

    // Saved IDs for Home hearts and counter
    public function ids(Request $request): JsonResponse
    {
        return response()->json([
            'ids' => Wishlist::query()
                ->where('user_id', $request->user()->id)
                ->pluck('product_id'),
        ]);
    }

    // Add or remove using the heart button
    public function toggle(
        Request $request,
        Product $product
    ): JsonResponse {
        $userId = $request->user()->id;

        $existing = Wishlist::query()
            ->where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $saved = false;
        } else {
            Wishlist::firstOrCreate([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);

            $saved = true;
        }

        return response()->json([
            'saved' => $saved,
            'ids' => Wishlist::query()
                ->where('user_id', $userId)
                ->pluck('product_id'),
        ]);
    }

    // Remove from My Wishlist page
    public function destroy(
        Request $request,
        Product $product
    ): RedirectResponse {
        Wishlist::query()
            ->where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->delete();

        return back()->with(
            'success',
            'Product removed from your wishlist.'
        );
    }

    // Import favorites previously saved in browser
    public function import(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_ids' => [
                'required', 'array', 'max:100',
            ],
            'product_ids.*' => [
                'integer', 'min:1',
            ],
        ]);

        $ids = array_unique($data['product_ids']);

        $validIds = Product::query()
            ->whereIn('id', $ids)
            ->pluck('id');

        $now = now();

        $rows = $validIds->map(function ($id) use ($request, $now) {
            return [
                'user_id' => $request->user()->id,
                'product_id' => $id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();

        if ($rows) {
            DB::table('wishlists')->insertOrIgnore($rows);
        }

        return $this->ids($request);
    }
}
