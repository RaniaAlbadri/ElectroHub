<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->withCount('items')
            ->latest()
            ->paginate(8);

        return view('account.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, Order $order)
    {
        // Only the owner can access this order.
        abort_unless(
            (int) $order->user_id ===
            (int) $request->user()->id,
            404
        );

        $order->load('items');

        return view('account.orders.show', [
            'order' => $order,
        ]);
    }
}
