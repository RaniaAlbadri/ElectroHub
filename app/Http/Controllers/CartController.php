<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $products = Product::with('category')
            ->whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->get();

        $items = $products->map(function ($product) use ($cart) {
            $quantity = max(0, (int) ($cart[$product->id] ?? 0));

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];

        })->filter(function ($item) {
            return $item['quantity'] > 0;
        });

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'nullable|integer|min:1|max:10',
        ]);

        $quantity = (int) ($data['quantity'] ?? 1);

        // Check product availability
        $product->load('category');

        abort_unless(
            $product->is_active &&
            $product->category?->is_active,
            404
        );

        if ($product->stock < 1) {
            return back()->withErrors([
                'cart' => 'This product is out of stock.',
            ]);
        }

        // Get current cart from session
        $cart = session()->get('cart', []);

        $currentQuantity = (int) ($cart[$product->id] ?? 0);

        $newQuantity = $currentQuantity + $quantity;

        // Check available stock
        if ($newQuantity > $product->stock) {
            return back()->withErrors([
                'cart' => 'Not enough stock available.',
            ]);
        }

        // Save product quantity
        $cart[$product->id] = $newQuantity;

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Product added to cart successfully!'
        );
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$product->id]);

        $request->session()->put('cart', $cart);

        return back()->with(
            'success',
            'Product removed from cart.'
        );
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $quantity = (int) $data['quantity'];

        $cart = $request->session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return redirect()->route('cart.index')
                ->withErrors([
                    'cart' => 'Product not found in cart.',
                ]);
        }

        if (!$product->is_active || $quantity > $product->stock) {
            return redirect()->route('cart.index')
                ->withErrors([
                    'cart' => 'Requested quantity is not available.',
                ]);
        }

        $cart[$product->id] = $quantity;

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully!');
    }


}
