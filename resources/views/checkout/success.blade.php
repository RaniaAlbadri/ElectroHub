
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Order Confirmed | ElectroHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('checkout._styles')
</head>

<body>

    <!-- Top Bar -->
    <div class="topbar">
        ElectroHub · Modern technology, everyday essentials
        · Portfolio demo
    </div>

    <!-- Header -->
    <header class="head">

        <div class="wrap nav">

            <a href="{{ route('home') }}"
               class="logo">

                <span class="logo-mark">E</span>

                <span>
                    Electro<span>Hub</span>
                </span>
            </a>

            <nav class="nav-links"
                 aria-label="Main navigation">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <a href="{{ route('shop.index') }}">
                    Shop
                </a>

                <a href="{{ route('cart.index') }}">
                    Cart
                </a>

            </nav>

        </div>

    </header>

    <main class="wrap">

        <div class="crumb">
            <a href="{{ route('home') }}">Home</a>
            › Order Confirmation
        </div>

        <section class="confirmation">

            <div class="checkmark"
                 aria-hidden="true">
                ✓
            </div>

            <h1>Demo Order Placed!</h1>

            <p class="lead">
                Your sample order was saved
                successfully in MySQL.
                No payment was charged.
            </p>

            <!-- Order Number -->
            <div class="confirm-number">
                Order: {{ $order->order_number }}
            </div>

            <div class="confirm-grid">

                <!-- Customer Information -->
                <div>

                    <strong>Customer Details</strong>

                    {{ $order->customer_name }}
                    <br>

                    {{ $order->customer_email }}
                    <br>

                    {{ $order->city }}
                    <br>

                    {{ $order->shipping_address }}

                </div>

                <!-- Order Products -->
                <div>

                    <strong>Order Summary</strong>

                    @foreach ($order->items as $item)

                        {{ $item->product_name }}

                        × {{ $item->quantity }}

                        —

                        ${{ number_format(
                            (float) $item->subtotal,
                            2
                        ) }}

                        <br>

                    @endforeach

                    <strong style="margin-top:10px">
                        Total:
                        ${{ number_format(
                            (float) $order->total_amount,
                            2
                        ) }}
                    </strong>

                    <small style="color:#718099">
                        Status:
                        {{ ucfirst($order->status) }}
                        · Demo Payment
                    </small>

                </div>

            </div>

            <p class="legal">
                This confirmation is available only
                in the browser session that placed
                this demo order.
            </p>

            <a href="{{ route('shop.index') }}"
               class="primary">
                Continue Shopping →
            </a>

        </section>

    </main>

    <!-- Footer -->
    <footer class="footer">

        <div class="wrap">

            <strong>ElectroHub</strong>

            <span>
                Laravel · MySQL · Portfolio Demonstration
            </span>

        </div>

    </footer>

</body>
</html>
