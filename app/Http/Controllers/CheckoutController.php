<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    // Display checkout page
    public function create(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->withErrors([
                    'cart' => 'Your cart is empty.'
                ]);
        }

        $products = Product::with('category')
            ->whereIn('id', array_keys($cart))
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->get()
            ->keyBy('id');

        $items = collect();
        $totalCents = 0;

        foreach ($cart as $id => $qty) {
            $product = $products->get((int) $id);
            $quantity = filter_var(
                $qty,
                FILTER_VALIDATE_INT
            );

            if (
                !$product ||
                $quantity === false ||
                $quantity < 1 ||
                $quantity > 10 ||
                $quantity > $product->stock
            ) {
                return redirect()
                    ->route('cart.index')
                    ->withErrors([
                        'cart' => 'Please review your cart.'
                    ]);
            }

            $priceCents = (int) round(
                (float) $product->price * 100
            );

            $lineCents = $priceCents * $quantity;
            $totalCents += $lineCents;

            $items->push([
                'product' => $product,
                'quantity' => $quantity,
                'line_total' => $lineCents / 100,
            ]);
        }

        return view('checkout.index', [
            'items' => $items,
            'total' => $totalCents / 100,
        ]);
    }

    // Save demo order
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|min:2|max:120',
            'customer_email' => 'required|email|max:190',
            'customer_phone' => 'required|string|min:7|max:30',
            'city' => 'required|string|max:120',
            'shipping_address' => 'required|string|min:8|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->withErrors([
                    'cart' => 'Your cart is empty.'
                ]);
        }

        $order = DB::transaction(function () use ($cart, $data) {

            $ids = collect(array_keys($cart))
                ->map(fn ($id) => (int) $id)
                ->sort()
                ->values()
                ->all();

            $products = Product::with('category')
                ->whereIn('id', $ids)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $lines = [];
            $totalCents = 0;

            foreach ($ids as $id) {
                $product = $products->get($id);

                $quantity = filter_var(
                    $cart[$id] ?? null,
                    FILTER_VALIDATE_INT
                );

                if (
                    !$product ||
                    !$product->is_active ||
                    !$product->category?->is_active ||
                    $quantity === false ||
                    $quantity < 1 ||
                    $quantity > 10 ||
                    $quantity > $product->stock
                ) {
                    throw ValidationException::withMessages([
                        'cart' => 'A product is unavailable or the quantity exceeds stock.'
                    ]);
                }

                $priceCents = (int) round(
                    (float) $product->price * 100
                );

                $lineCents = $priceCents * $quantity;
                $totalCents += $lineCents;

                $lines[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => number_format(
                        $priceCents / 100, 2, '.', ''
                    ),
                    'subtotal' => number_format(
                        $lineCents / 100, 2, '.', ''
                    ),
                ];
            }

            $order = Order::create([
                'order_number' => 'EH-' . Str::ulid(),
                'user_id' => auth()->id(),
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'city' => $data['city'],
                'shipping_address' => $data['shipping_address'],
                'notes' => $data['notes'] ?? null,
                'total_amount' => number_format(
                    $totalCents / 100, 2, '.', ''
                ),
                'status' => 'pending',
                'payment_method' => 'demo',
            ]);

            foreach ($lines as $line) {
                $order->items()->create([
                    'product_id' => $line['product']->id,
                    'product_name' => $line['product']->name,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'],
                    'subtotal' => $line['subtotal'],
                ]);

                $line['product']->decrement(
                    'stock',
                    $line['quantity']
                );
            }

            return $order;

        }, 3);

        // Empty cart after successful order
        $request->session()->forget('cart');

        $request->session()->put(
            'last_order_id',
            $order->id
        );

        return redirect()->route('checkout.success');
    }

    // Display order confirmation
    public function success(Request $request)
    {
        $orderId = $request->session()
            ->get('last_order_id');

        if (!$orderId) {
            return redirect()->route('shop.index');
        }

        $order = Order::with('items')
            ->findOrFail($orderId);

        return view('checkout.success', compact('order'));
    }
}
