
@extends('layouts.electrohub-account')

@section('title', 'Order Details')

@section('content')

    <div class="eh-crumb">
        <a href="{{ route('home') }}">Home</a>
        /
        <a href="{{ route('orders.index') }}">My Orders</a>
        / Order Details
    </div>

    <div class="eh-heading">
        <h1>Order Details</h1>

        <p>
            Review the information and products
            included in your order.
        </p>
    </div>

    <!-- Main Order Information -->
    <section class="eh-card"
             style="margin-bottom:22px">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;
            flex-wrap:wrap;
        ">

            <div>
                <p class="eh-muted"
                   style="margin:0 0 7px">
                    ORDER NUMBER
                </p>

                <h2 style="margin:0;overflow-wrap:anywhere">
                    {{ $order->order_number }}
                </h2>

                <p class="eh-muted"
                   style="margin:8px 0 0">
                    Placed on
                    {{ $order->created_at->format('M d, Y') }}
                </p>
            </div>

            <span class="eh-status {{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>

        </div>

    </section>

    <div class="eh-grid">

        <!-- Ordered Products -->
        <section class="eh-card">

            <h2>Ordered Products</h2>

            <p class="eh-subtitle">
                Items included in this order.
            </p>

            @foreach ($order->items as $item)

                <div class="eh-summary"
                     style="align-items:center">

                    <div style="min-width:0">
                        <strong style="
                            display:block;
                            font-size:13px;
                            margin-bottom:6px;
                        ">
                            {{ $item->product_name }}
                        </strong>

                        <span class="eh-muted"
                              style="font-size:12px">
                            Quantity:
                            {{ $item->quantity }}

                            × ${{ number_format(
                                (float) $item->unit_price,
                                2
                            ) }}
                        </span>
                    </div>

                    <strong style="white-space:nowrap">
                        ${{ number_format(
                            (float) $item->subtotal,
                            2
                        ) }}
                    </strong>

                </div>

            @endforeach

            <div class="eh-summary"
                 style="margin-top:15px;font-size:17px">
                <strong>Order Total</strong>

                <strong>
                    ${{ number_format(
                        (float) $order->total_amount,
                        2
                    ) }}
                </strong>
            </div>

        </section>

        <!-- Customer Information -->
        <section class="eh-card">

            <h2>Customer Information</h2>

            <p class="eh-subtitle">
                Information submitted at checkout.
            </p>

            <div class="eh-summary">
                <span class="eh-muted">Name</span>
                <strong>{{ $order->customer_name }}</strong>
            </div>

            <div class="eh-summary">
                <span class="eh-muted">Email</span>
                <strong style="overflow-wrap:anywhere">
                    {{ $order->customer_email }}
                </strong>
            </div>

            <div class="eh-summary">
                <span class="eh-muted">Phone</span>
                <strong>{{ $order->customer_phone }}</strong>
            </div>

            <div class="eh-summary">
                <span class="eh-muted">City</span>
                <strong>{{ $order->city }}</strong>
            </div>

            <div class="eh-summary">
                <span class="eh-muted">Address</span>

                <strong style="
                    max-width:55%;
                    text-align:right;
                    overflow-wrap:anywhere;
                    white-space:pre-line;
                ">{{ $order->shipping_address }}</strong>
            </div>

            @if ($order->notes)
                <div class="eh-summary">
                    <span class="eh-muted">Notes</span>

                    <strong style="
                        max-width:55%;
                        text-align:right;
                        white-space:pre-line;
                        overflow-wrap:anywhere;
                    ">{{ $order->notes }}</strong>
                </div>
            @endif

            <div class="eh-summary">
                <span class="eh-muted">Payment</span>
                <strong>Demo Payment</strong>
            </div>

        </section>

    </div>

    <div style="margin-top:24px">
        <a href="{{ route('orders.index') }}"
           class="eh-btn eh-btn-secondary">
            ← Back to My Orders
        </a>
    </div>

@endsection
