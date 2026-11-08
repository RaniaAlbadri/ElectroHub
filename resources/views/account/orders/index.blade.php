
@extends('layouts.electrohub-account')

@section('title', 'My Orders')

@section('content')

    <div class="eh-crumb">
        <a href="{{ route('home') }}">Home</a>
        / <a href="{{ route('profile.edit') }}">My Account</a>
        / My Orders
    </div>

    <div class="eh-heading">
        <h1>My Orders</h1>

        <p>
            Track your demo purchases and
            review your order history.
        </p>
    </div>

    <section class="eh-card">

        <h2>Order History</h2>

        <p class="eh-subtitle">
            Orders associated with your ElectroHub account.
        </p>

        @if ($orders->count() > 0)

            <div class="eh-table-wrap">

                <table class="eh-table">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)

                            <tr>
                                <td>
                                    <strong>
                                        {{ $order->order_number }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    {{ $order->items_count }}
                                </td>

                                <td>
                                    <strong>
                                        ${{ number_format(
                                            (float) $order->total_amount,
                                            2
                                        ) }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="eh-status {{ $order->status }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a class="eh-link"
                                       href="{{ route('orders.show', $order) }}">
                                        View Details →
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>

            <div style="margin-top:25px">
                {{ $orders->links() }}
            </div>

        @else

            <div class="eh-empty">
                <div class="eh-empty-icon">▣</div>

                <h2>No Orders Yet</h2>

                <p class="eh-subtitle">
                    You haven't placed an order
                    with this account yet.
                </p>

                <a href="{{ route('shop.index') }}"
                   class="eh-btn">
                    Explore Products →
                </a>
            </div>

        @endif

    </section>

@endsection
