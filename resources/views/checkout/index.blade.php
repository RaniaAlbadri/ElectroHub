
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Checkout | ElectroHub</title>

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

            <a href="{{ route('home') }}" class="logo">
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

        <!-- Breadcrumb -->
        <div class="crumb">
            <a href="{{ route('home') }}">Home</a>
            ›
            <a href="{{ route('cart.index') }}">Cart</a>
            › Checkout
        </div>

        <h1>Secure Demo Checkout</h1>

        <p class="lead">
            Enter your details and place a sample order.
            No real payment or delivery will be processed.
        </p>

        <div class="layout">

            <!-- Customer Form -->
            <section class="panel"
                     aria-labelledby="shipping-heading">

                <h2 id="shipping-heading">
                    <span class="num">1</span>
                    Customer & Delivery Details
                </h2>

                @if ($errors->any())
                    <div class="banner-error" role="alert">
                        Please check your information and try again.
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('checkout.store') }}"
                      id="checkout-form">

                    @csrf

                    <div class="grid">

                        <!-- Full Name -->
                        <div class="field full">
                            <label for="customer_name">
                                Full Name *
                            </label>

                            <input
                                id="customer_name"
                                name="customer_name"
                                type="text"
                                maxlength="120"
                                autocomplete="name"
                                value="{{ old('customer_name') }}"
                                placeholder="Your full name"
                                required
                            >

                            @error('customer_name')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="field">
                            <label for="customer_email">
                                Email Address *
                            </label>

                            <input
                                id="customer_email"
                                name="customer_email"
                                type="email"
                                maxlength="190"
                                autocomplete="email"
                                value="{{ old('customer_email') }}"
                                placeholder="name@example.com"
                                required
                            >

                            @error('customer_email')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="field">
                            <label for="customer_phone">
                                Phone Number *
                            </label>

                            <input
                                id="customer_phone"
                                name="customer_phone"
                                type="tel"
                                minlength="7"
                                maxlength="30"
                                autocomplete="tel"
                                value="{{ old('customer_phone') }}"
                                placeholder="07XXXXXXXXX"
                                required
                            >

                            @error('customer_phone')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="field">
                            <label for="city">
                                City *
                            </label>

                            <input
                                id="city"
                                name="city"
                                type="text"
                                maxlength="120"
                                autocomplete="address-level2"
                                value="{{ old('city') }}"
                                placeholder="Your city"
                                required
                            >

                            @error('city')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="field full">
                            <label for="shipping_address">
                                Address *
                            </label>

                            <textarea
                                id="shipping_address"
                                name="shipping_address"
                                maxlength="500"
                                minlength="8"
                                autocomplete="street-address"
                                placeholder="Street, area and house number"
                                required
                            >{{ old('shipping_address') }}</textarea>

                            @error('shipping_address')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="field full">
                            <label for="notes">
                                Order Notes (Optional)
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                maxlength="1000"
                                placeholder="Any special instructions"
                            >{{ old('notes') }}</textarea>

                            @error('notes')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="demo">
                        <span>ⓘ</span>

                        <div>
                            <strong>
                                Portfolio Demo Checkout
                            </strong>

                            <div>
                                This form saves a sample order
                                in MySQL. No payment is collected,
                                no items are shipped, and no
                                confirmation email is sent.
                            </div>
                        </div>
                    </div>

                </form>
            </section>

            <!-- Order Summary -->
            <aside class="panel"
                   aria-label="Order summary">

                <h2>
                    <span class="num">2</span>
                    Order Summary
                </h2>

                @foreach ($items as $item)

                    <div class="order-product">

                        <div class="product-art"
                             aria-hidden="true">
                            ◈
                        </div>

                        <div class="order-product-text">

                            <strong>
                                {{ $item['product']->name }}
                            </strong>

                            <small>
                                Quantity:
                                {{ $item['quantity'] }}

                                · ${{ number_format(
                                    (float) $item['product']->price,
                                    2
                                ) }} each
                            </small>
                        </div>

                        <span class="price">
                            ${{ number_format(
                                (float) $item['line_total'],
                                2
                            ) }}
                        </span>

                    </div>

                @endforeach

                <!-- Subtotal -->
                <div class="summary-row muted">
                    <span>Subtotal</span>
                    <strong>
                        ${{ number_format((float) $total, 2) }}
                    </strong>
                </div>

                <!-- Shipping -->
                <div class="summary-row muted">
                    <span>Shipping</span>
                    <span>Not applicable (demo)</span>
                </div>

                <!-- Total -->
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <strong>
                        ${{ number_format((float) $total, 2) }}
                    </strong>
                </div>

                <!-- Place Order -->
                <button
                    type="submit"
                    form="checkout-form"
                    class="primary"
                    id="place-order"
                >
                    Place Demo Order →
                </button>

                <p class="legal">
                    This creates a demo order in your local
                    database. No payment is charged.
                </p>

                <a class="secondary"
                   href="{{ route('cart.index') }}">
                    ← Return to Cart
                </a>

            </aside>

        </div>

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

    <script>
        const checkoutForm =
            document.getElementById('checkout-form');

        const placeOrderButton =
            document.getElementById('place-order');

        checkoutForm.addEventListener('submit', () => {
            placeOrderButton.disabled = true;
            placeOrderButton.textContent =
                'Placing your demo order...';
        });

        window.addEventListener('pageshow', () => {
            placeOrderButton.disabled = false;
            placeOrderButton.textContent =
                'Place Demo Order →';
        });
    </script>

</body>
</html>
