<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101b31">
    <title>Shopping Cart | ElectroHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --navy:#101b31; --blue:#2477ee; --ink:#17233a; --muted:#738197; --line:#e8edf5; --soft:#f5f8fc; }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif; color:var(--ink); background:#f8fafd; }
        a { color:inherit; text-decoration:none; }
        button,input { font:inherit; }
        button { cursor:pointer; }
        img { display:block; max-width:100%; }
        .container { width:min(1200px,calc(100% - 40px)); margin-inline:auto; }
        .topbar { background:#101b31; color:#cbd9ec; font-size:11px; padding:11px 0; text-align:center; }
        .header { background:#fff; border-bottom:1px solid var(--line); }
        .header-row { display:flex; align-items:center; justify-content:space-between; gap:20px; min-height:78px; }
        .logo { display:flex; align-items:center; gap:10px; font-size:23px; font-weight:850; letter-spacing:-1px; }
        .logo-badge { display:grid; place-items:center; width:40px; height:40px; background:linear-gradient(135deg,#2d87ff,#6860f3); color:white; border-radius:12px; font-size:25px; }
        .logo em { font-style:normal; color:var(--blue); }
        .nav { display:flex; align-items:center; gap:26px; font-size:13px; font-weight:650; }
        .nav a:hover { color:var(--blue); }
        .nav .active { color:var(--blue); }
        .cart-count { background:var(--blue); color:#fff; border-radius:30px; font-size:11px; padding:3px 7px; margin-left:4px; }
        .breadcrumb { color:#8795a8; font-size:12px; display:flex; gap:10px; align-items:center; margin:28px 0; }
        .breadcrumb a:hover { color:var(--blue); }
        .page-title { margin:0; font-size:clamp(28px,3vw,38px); letter-spacing:-1px; }
        .subtitle { margin:8px 0 26px; color:var(--muted); font-size:13px; }
        .flash { padding:14px 17px; border-radius:10px; font-size:13px; margin-bottom:20px; }
        .flash.success { background:#e9f8ef; color:#17643b; border:1px solid #c9ebd6; }
        .flash.error { background:#fff0f0; color:#ac3028; border:1px solid #f5cccc; }
        .layout { display:grid; grid-template-columns:minmax(0,1fr) 340px; gap:23px; align-items:start; margin-bottom:64px; }
        .panel { background:#fff; border:1px solid var(--line); border-radius:14px; box-shadow:0 8px 30px #10274f06; }
        .panel-heading { display:flex; justify-content:space-between; align-items:center; gap:14px; padding:22px 23px; border-bottom:1px solid var(--line); }
        .panel-heading h2 { font-size:18px; margin:0; }
        .panel-heading .count { font-size:12px; color:var(--muted); }
        .cart-item { display:grid; grid-template-columns:112px minmax(0,1fr) auto; align-items:center; gap:19px; padding:23px; border-bottom:1px solid var(--line); }
        .cart-item:last-child { border-bottom:0; }
        .product-image { display:grid; place-items:center; aspect-ratio:1; background:#f5f8fc; border-radius:11px; overflow:hidden; }
        .product-image img { width:100%; height:100%; object-fit:contain; padding:8px; }
        .item-category { text-transform:uppercase; letter-spacing:.8px; color:#4282cc; font-size:10px; font-weight:750; }
        .item-name { display:inline-block; font-size:15px; font-weight:750; line-height:1.45; margin:7px 0; }
        .item-name:hover { color:var(--blue); }
        .item-price { color:#244b78; font-size:14px; font-weight:750; }
        .stock { color:#178251; font-size:11px; margin-top:7px; }
        .item-controls { display:flex; flex-direction:column; align-items:end; gap:11px; }
        .qty { height:39px; border:1px solid #dce6f2; display:flex; align-items:center; border-radius:8px; overflow:hidden; }
        .qty button { border:0; height:100%; width:34px; background:#f4f8fc; color:#183b64; font-size:18px; }
        .qty button:hover { background:#e5f0ff; }
        .qty input { border:0; outline:0; text-align:center; width:39px; height:100%; background:white; font-size:13px; font-weight:750; appearance:textfield; }
        .qty input::-webkit-inner-spin-button,.qty input::-webkit-outer-spin-button { -webkit-appearance:none; margin:0; }
        .item-subtotal { font-size:17px; font-weight:850; color:#1a3d66; }
        .remove { background:none; border:0; padding:0; font-size:12px; color:#cb4b5b; font-weight:650; }
        .remove:hover { text-decoration:underline; }
        .summary { padding:24px; position:sticky; top:20px; }
        .summary h2 { font-size:20px; margin:0 0 23px; }
        .sum-row { display:flex; justify-content:space-between; gap:10px; margin:16px 0; font-size:13px; color:#53627a; }
        .sum-row strong { color:#192f50; }
        .sum-total { border-top:1px solid var(--line); padding-top:20px; margin-top:21px; font-size:18px; font-weight:800; color:#162b49; }
        .sum-total strong { color:#1c69bd; font-size:23px; }
        .checkout { margin-top:20px; width:100%; padding:14px 16px; background:#2477ee; border:0; color:white; border-radius:9px; font-size:13px; font-weight:750; }
        .checkout:disabled { background:#94abd0; cursor:not-allowed; }
        .note { color:#8794a7; font-size:11px; line-height:1.7; text-align:center; margin:14px 0 0; }
        .continue { display:inline-flex; align-items:center; gap:8px; color:var(--blue); font-size:13px; font-weight:750; margin-top:21px; }
        .empty { padding:55px 22px; text-align:center; }
        .empty-icon { margin:0 auto 16px; display:grid; place-items:center; width:78px; height:78px; border-radius:50%; background:#eaf2ff; color:#2879c1; font-size:33px; }
        .empty h2 { margin:0 0 10px; font-size:23px; }
        .empty p { color:var(--muted); font-size:13px; }
        .shop-button { display:inline-block; margin-top:16px; padding:13px 24px; border-radius:9px; background:var(--blue); color:#fff; font-size:13px; font-weight:750; }
        .footer { background:#101b31; color:#b8c9e1; padding:29px 0; font-size:12px; }
        .footer .container { display:flex; justify-content:space-between; flex-wrap:wrap; gap:14px; }
        .footer strong { color:#fff; font-size:17px; }
        @media(max-width:900px) { .layout { grid-template-columns:1fr; } .summary { position:static; } }
        @media(max-width:600px) {
            .container { width:calc(100% - 28px); }
            .logo { font-size:19px; }
            .logo-badge { width:34px; height:34px; font-size:21px; }
            .header-row { min-height:70px; }
            .nav { gap:12px; font-size:11px; }
            .nav a:first-child { display:none; }
            .cart-item { grid-template-columns:84px minmax(0,1fr); gap:13px; padding:15px; }
            .item-controls { grid-column:1 / -1; display:grid; grid-template-columns:1fr auto; align-items:center; justify-items:start; gap:9px; border-top:1px dashed var(--line); padding-top:12px; }
            .item-controls .item-subtotal { grid-column:2; grid-row:1; }
            .item-controls form.remove-form { grid-column:2; grid-row:2; justify-self:end; }
            .item-name { font-size:13px; }
            .panel-heading { padding:17px; }
        }
    </style>
</head>
<body>
    @php
        $fallbackImages = [
            'earbud' => 'earbuds', 'headphone' => 'headphones',
            'keyboard' => 'keyboard', 'mouse' => 'mouse',
            'power bank' => 'powerbank', 'charger' => 'charger',
            'watch' => 'watch', 'lamp' => 'lamp', 'light' => 'lamp',
            'stand' => 'stand', 'speaker' => 'speaker',
        ];
        $imageFor = function ($product) use ($fallbackImages) {
            if ($product->image) {
                return asset('storage/' . $product->image);
            }
            $kind = 'headphones';
            foreach ($fallbackImages as $needle => $filename) {
                if (str_contains(strtolower($product->name), $needle)) {
                    $kind = $filename;
                    break;
                }
            }
            return asset('images/electrohub/' . $kind . '.svg');
        };
        $itemCount = $items->sum('quantity');
    @endphp

    <div class="topbar">ElectroHub — Portfolio Demo Store · Sample products and prices · No real purchases</div>
    <header class="header">
        <div class="container header-row">
            <a href="{{ route('home') }}" class="logo" aria-label="ElectroHub Home">
                <span class="logo-badge">E</span><span>Electro<em>Hub</em></span>
            </a>
            <nav class="nav" aria-label="Main navigation">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop.index') }}">Shop</a>
                <a href="{{ route('cart.index') }}" class="active">Cart <span class="cart-count">{{ $itemCount }}</span></a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span>›</span> <span>Shopping Cart</span></div>
        <h1 class="page-title">Your Shopping Cart</h1>
        <p class="subtitle">Review your selected tech accessories before checkout.</p>

        @if (session('success'))
            <div class="flash success" role="status">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="flash error" role="alert">{{ $errors->first() }}</div>
        @endif

        @if ($items->isEmpty())
            <div class="panel empty">
                <div class="empty-icon" aria-hidden="true">🛒</div>
                <h2>Your cart is empty</h2>
                <p>Find your next favorite gadget in the ElectroHub collection.</p>
                <a class="shop-button" href="{{ route('shop.index') }}">Explore Products →</a>
            </div>
        @else
            <div class="layout">
                <section class="panel" aria-labelledby="cart-heading">
                    <div class="panel-heading"><h2 id="cart-heading">Cart Items</h2><span class="count">{{ $itemCount }} item(s)</span></div>
                    @foreach ($items as $item)
                        @php
                            $product = $item['product'];
                            $quantity = $item['quantity'];
                            $maxQuantity = max(1, min(10, (int) $product->stock));
                        @endphp
                        <article class="cart-item">
                            <a href="{{ route('shop.show', ['product' => $product->slug]) }}" class="product-image">
                                <img src="{{ $imageFor($product) }}" alt="{{ $product->name }}" width="160" height="160" loading="lazy">
                            </a>
                            <div>
                                <span class="item-category">{{ $product->category?->name ?? 'Electronics' }}</span>
                                <a class="item-name" href="{{ route('shop.show', ['product' => $product->slug]) }}">{{ $product->name }}</a>
                                <div class="item-price">${{ number_format((float) $product->price, 2) }} each</div>
                                <div class="stock">{{ $product->stock > 0 ? 'In stock · ' . $product->stock . ' available' : 'Currently out of stock' }}</div>
                            </div>
                            <div class="item-controls">
                                <form method="POST" action="{{ route('cart.update', $product->id) }}" class="qty" data-quantity-form>
                                    @csrf
                                    <button type="button" data-step="-1" aria-label="Decrease quantity of {{ $product->name }}">−</button>
                                    <input type="number" name="quantity" min="1" max="{{ $maxQuantity }}" value="{{ $quantity }}" readonly aria-label="Quantity of {{ $product->name }}">
                                    <button type="button" data-step="1" aria-label="Increase quantity of {{ $product->name }}">+</button>
                                </form>
                                <span class="item-subtotal">${{ number_format((float) $item['subtotal'], 2) }}</span>
                                <form class="remove-form" method="POST" action="{{ route('cart.remove', $product->id) }}">
                                    @csrf
                                    <button class="remove" type="submit">Remove item</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </section>

                <aside class="panel summary" aria-label="Order summary">
                    <h2>Order Summary</h2>
                    <div class="sum-row"><span>Items ({{ $itemCount }})</span><strong>${{ number_format((float) $total, 2) }}</strong></div>
                    <div class="sum-row"><span>Shipping</span><span>Calculated at checkout</span></div>
                    <div class="sum-row sum-total"><span>Subtotal</span><strong>${{ number_format((float) $total, 2) }}</strong></div>

                    <a
                        href="{{ route('checkout.create') }}"
                        class="checkout"
                        style="
                            display: block;
                            text-align: center;
                            text-decoration: none;
                        "
                    >
                        Proceed to Checkout →
                    </a>


                    <p class="note">
                        Demo checkout: no real payment or shipping.
                    </p>

                    <a class="continue" href="{{ route('shop.index') }}">← Continue Shopping</a>
                </aside>
            </div>
        @endif
    </main>

    <footer class="footer"><div class="container"><strong>ElectroHub</strong><span>Built with Laravel & MySQL · Portfolio Demo © 2026</span></div></footer>

    <script>
        document.querySelectorAll('[data-quantity-form]').forEach((form) => {
            const input = form.querySelector('input[name="quantity"]');
            const max = Number(input.max);
            form.querySelectorAll('[data-step]').forEach((button) => {
                button.addEventListener('click', () => {
                    const current = Number(input.value);
                    const next = Math.min(max, Math.max(1, current + Number(button.dataset.step)));
                    if (next !== current) {
                        input.value = next;
                        form.requestSubmit();
                    }
                });
            });
        });
    </script>
</body>
</html>
