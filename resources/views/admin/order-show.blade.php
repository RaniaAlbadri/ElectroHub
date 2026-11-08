
@extends('admin.layout')

@section('title', 'Order Details')

@section('content')

<div class="heading">

    <div>
        <h1>Order Details</h1>
        <p class="muted">
            Review order information and update its status.
        </p>
    </div>

    <a href="{{ route('admin.orders.index') }}"
       class="btn btn-light">
        ← Back to Orders
    </a>

</div>

<section class="card">

    <div class="heading">
        <div>
            <p class="muted">ORDER NUMBER</p>

            <h2 style="overflow-wrap:anywhere">
                {{ $order->order_number }}
            </h2>

            <p class="muted">
                Placed on
                {{ $order->created_at->format('M d, Y') }}
            </p>
        </div>

        <span class="status {{ $order->status }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <h2>Order Status</h2>

    @if(in_array($order->status, ['pending', 'processing']))


            <form
                method="POST"
                action="{{ route('admin.orders.update', $order) }}"
                data-confirm="Update Order Status?"
                data-confirm-text="Are you sure you want to change this order status?"
                data-confirm-button="Yes, Update"
            >


            @csrf
            @method('PATCH')

            <div class="form-grid">

                <div class="field">
                    <label for="status">
                        Change Status
                    </label>

                    <select class="input"
                            name="status"
                            id="status"
                            required>

                        @if($order->status === 'pending')
                            <option value="processing">
                                Processing
                            </option>
                        @endif

                        <option value="completed">
                            Completed
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>
                </div>

                <div class="field"
                     style="display:flex;align-items:end">

                    <button type="submit"
                            class="btn"
                            onclick="return confirm('Update this order status?');">
                        Update Status
                    </button>

                </div>

            </div>

        </form>

        <p class="muted">
            Cancelling an order restores available stock
            for products that still exist.
            Completed and cancelled orders are final.
        </p>

    @else

        <p class="muted">
            This order is final and cannot be edited.
        </p>

    @endif

</section>

<div style="
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:20px;
">

    <section class="card">

        <h2>Order Items</h2>

        @foreach($order->items as $item)

            <div class="info-row">

                <div>
                    <strong>
                        {{ $item->product_name }}
                    </strong>

                    <p class="muted">
                        {{ $item->quantity }}
                        × ${{ number_format(
                            (float)$item->unit_price, 2
                        ) }}
                    </p>
                </div>

                <strong>
                    ${{ number_format(
                        (float)$item->subtotal, 2
                    ) }}
                </strong>

            </div>

        @endforeach

        <div class="info-row">
            <strong>Total Amount</strong>

            <strong style="color:#2477ee">
                ${{ number_format(
                    (float)$order->total_amount, 2
                ) }}
            </strong>
        </div>

    </section>

    <section class="card">

        <h2>Customer Details</h2>

        <div class="info-row">
            <span class="muted">Name</span>
            <strong>{{ $order->customer_name }}</strong>
        </div>

        <div class="info-row">
            <span class="muted">Email</span>
            <strong style="overflow-wrap:anywhere">
                {{ $order->customer_email }}
            </strong>
        </div>

        <div class="info-row">
            <span class="muted">Phone</span>
            <strong>{{ $order->customer_phone }}</strong>
        </div>

        <div class="info-row">
            <span class="muted">City</span>
            <strong>{{ $order->city }}</strong>
        </div>

        <div class="info-row">
            <span class="muted">Address</span>
            <strong style="
                text-align:right;
                max-width:60%;
                white-space:pre-line;
                overflow-wrap:anywhere;
            ">{{ $order->shipping_address }}</strong>
        </div>

        @if($order->notes)
            <div class="info-row">
                <span class="muted">Notes</span>
                <strong style="white-space:pre-line">
                    {{ $order->notes }}
                </strong>
            </div>
        @endif

        <div class="info-row">
            <span class="muted">Payment Method</span>
            <strong>Demo Payment</strong>
        </div>

    </section>

</div>

@endsection
