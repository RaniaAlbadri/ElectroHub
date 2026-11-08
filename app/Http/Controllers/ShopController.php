<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Validate search and filter inputs
        $filters = $request->validate([
            'search' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'brand' => 'nullable|string|max:100',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'sort' => 'nullable|in:newest,price_asc,price_desc',
        ]);

        // Get active categories
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Get available brands
        $brands = Product::where('is_active', true)
            ->whereNotNull('brand')
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        // Build products query
        $query = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            });

        // Search by name or brand
        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        // Category filter
        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // Brand filter
        if (!empty($filters['brand'])) {
            $query->where('brand', $filters['brand']);
        }

        // Price filters
        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        // Sorting
        switch ($filters['sort'] ?? 'newest') {
            case 'price_asc':
                $query->orderBy('price')->orderBy('id');
                break;

            case 'price_desc':
                $query->orderByDesc('price')->orderBy('id');
                break;

            default:
                $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();


        if ($request->filled('brand')) {
            $brand = trim((string) $request->query('brand'));

            $query->where('brand', $brand);
        }

        return view('shop.index', compact(
            'products',
            'categories',
            'brands'
        ));

    }

    public function show(Product $product)
    {
        $product->load('category');

        abort_unless(
            $product->is_active &&
            $product->category?->is_active,
            404
        );

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        return view('shop.show', compact(
            'product',
            'relatedProducts'
        ));
    }

}
