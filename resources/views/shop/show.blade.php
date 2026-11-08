<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101b31">
    <title>{{ $product->name }} | ElectroHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #101b31;
            --blue: #2477ee;
            --ink: #17233a;
            --muted: #748197;
            --border: #e8edf5;
            --soft: #f5f7fb;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: #fff;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
        }

        button,
        input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .eh-container {
            width: min(1280px, calc(100% - 56px));
            margin-inline: auto;
        }

        .eh-top {
            background: #0f192b;
            color: #dce7f4;
            font-size: 11px;
        }

        .eh-top .eh-container {
            min-height: 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .eh-head {
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .eh-head-inner {
            min-height: 84px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
        }

        .eh-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: none;
        }

        .eh-brand-mark {
            display: grid;
            place-items: center;
            width: 39px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2d87ff, #6f5aff);
            color: #fff;
            font-weight: 900;
            font-size: 24px;
            box-shadow: 0 6px 16px #2477ee36;
        }

        .eh-brand-copy {
            display: flex;
            flex-direction: column;
        }

        .eh-brand-copy strong {
            font-size: 23px;
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .eh-brand-copy strong span {
            color: #2378ee;
        }

        .eh-brand-copy small {
            color: #7d899a;
            font-size: 10px;
        }

        .eh-search {
            display: flex;
            min-width: 160px;
            flex: 1;
            max-width: 560px;
            height: 43px;
            border: 1px solid #e1e8f1;
            border-radius: 7px;
            background: #f9fbfd;
            overflow: hidden;
        }

        .eh-search:focus-within {
            border-color: #70aaff;
            box-shadow: 0 0 0 3px #2477ee13;
        }

        .eh-search input {
            flex: 1;
            min-width: 0;
            background: transparent;
            border: 0;
            padding: 0 14px;
            outline: none;
            color: var(--ink);
            font-size: 12px;
        }

        .eh-search button {
            width: 49px;
            flex: none;
            background: var(--blue);
            border: 0;
            color: #fff;
            font-size: 20px;
        }

        .eh-head-links {
            display: flex;
            align-items: center;
            gap: 19px;
        }

        .eh-head-links a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 650;
            white-space: nowrap;
        }

        .eh-head-links a:hover,
        .eh-nav a:hover {
            color: var(--blue);
        }

        .eh-head-links svg {
            width: 21px;
            height: 21px;
            stroke-width: 1.9;
        }

        .eh-cart-count {
            background: var(--blue);
            color: #fff;
            border-radius: 50px;
            padding: 2px 6px;
            min-width: 19px;
            text-align: center;
            font-size: 10px;
        }

        .eh-nav {
            border-bottom: 1px solid var(--border);
        }

        .eh-nav .eh-container {
            display: flex;
            gap: 30px;
            align-items: center;
            min-height: 47px;
            font-size: 12px;
            font-weight: 650;
        }

        .eh-nav .eh-current {
            color: var(--blue);
        }

        .eh-breadcrumbs {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin: 25px 0 30px;
            color: #8793a6;
            font-size: 12px;
        }

        .eh-breadcrumbs a:hover {
            color: var(--blue);
        }

        .eh-main {
            padding-bottom: 65px;
        }

        .eh-detail {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
            gap: 52px;
            align-items: start;
        }

        .eh-main-image {
            position: relative;
            border: 1px solid var(--border);
            background: linear-gradient(140deg, #f7f9fc, #eef4fa);
            border-radius: 18px;
            aspect-ratio: 1.12;
            overflow: hidden;
            display: grid;
            place-items: center;
        }

        .eh-main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 35px;
        }

        .eh-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: #e4f2ff;
            color: #176ddd;
            padding: 8px 11px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
        }

        .eh-thumb-note {
            margin-top: 12px;
            color: #96a2b3;
            font-size: 11px;
        }

        .eh-label {
            display: inline-block;
            color: #2477ee;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-size: 11px;
        }

        .eh-info h1 {
            font-size: clamp(28px, 3.3vw, 42px);
            line-height: 1.15;
            letter-spacing: -1.1px;
            margin: 13px 0 13px;
        }

        .eh-brandline {
            color: #75849b;
            font-size: 13px;
        }

        .eh-price {
            display: flex;
            align-items: baseline;
            gap: 13px;
            flex-wrap: wrap;
            margin: 22px 0;
            font-size: 31px;
            font-weight: 850;
            color: #193c67;
        }

        .eh-old {
            font-size: 16px;
            font-weight: 500;
            color: #9ca9ba;
            text-decoration: line-through;
        }

        .eh-hr {
            border: 0;
            background: var(--border);
            height: 1px;
            margin: 25px 0;
        }

        .eh-desc {
            color: #687890;
            font-size: 14px;
            line-height: 1.9;
            margin: 0;
        }

        .eh-stock {
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 750;
            color: #178251;
            background: #eaf9f0;
            padding: 9px 12px;
            border-radius: 8px;
        }

        .eh-stock.out {
            color: #b34c43;
            background: #fff1f0;
        }

        .eh-dot {
            height: 7px;
            width: 7px;
            background: currentColor;
            border-radius: 50%;
        }

        .eh-buyrow {
            display: flex;
            align-items: end;
            gap: 13px;
            margin-top: 29px;
        }

        .eh-qty-wrap {
            flex: none;
        }

        .eh-qty-wrap label {
            display: block;
            font-size: 11px;
            color: #75849b;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .eh-qty {
            display: flex;
            height: 48px;
            border: 1px solid #dce5f0;
            border-radius: 9px;
            overflow: hidden;
        }

        .eh-qty button {
            width: 35px;
            background: #f8fafe;
            border: 0;
            color: #1b3558;
            font-size: 19px;
        }

        .eh-qty button:hover {
            background: #eaf2ff;
        }

        .eh-qty input {
            width: 36px;
            border: 0;
            outline: 0;
            text-align: center;
            color: #1b3558;
            font-weight: 700;
            background: white;
            appearance: textfield;
        }

        .eh-add {
            min-height: 48px;
            flex: 1;
            border: 0;
            background: var(--blue);
            color: white;
            font-weight: 800;
            font-size: 13px;
            border-radius: 9px;
            padding: 12px 18px;
            transition: background .2s;
        }

        .eh-add:hover {
            background: #145ecd;
        }

        .eh-add:disabled {
            background: #b7c3d2;
            cursor: not-allowed;
        }

        .eh-detail-meta {
            margin-top: 24px;
            padding: 20px;
            border: 1px solid var(--border);
            background: #f9fbfe;
            border-radius: 12px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .eh-detail-meta div {
            font-size: 12px;
            color: #435470;
        }

        .eh-detail-meta strong {
            display: block;
            color: #8592a6;
            font-size: 10px;
            letter-spacing: .07em;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .eh-section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin: 65px 0 20px;
        }

        .eh-section-head h2 {
            font-size: 25px;
            letter-spacing: -.5px;
            margin: 0;
        }

        .eh-section-head a {
            color: var(--blue);
            font-size: 12px;
            font-weight: 750;
        }

        .eh-related-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 19px;
        }

        .eh-card {
            min-width: 0;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: box-shadow .2s, transform .2s;
        }

        .eh-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 13px 27px #223d6716;
        }

        .eh-card-photo {
            display: block;
            aspect-ratio: 1.18;
            background: #f5f8fc;
        }

        .eh-card-photo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 16px;
        }

        .eh-card-body {
            padding: 15px;
        }

        .eh-card-body small {
            color: #8793a5;
            font-size: 10px;
            text-transform: uppercase;
        }

        .eh-card-body h3 {
            font-size: 13px;
            line-height: 1.5;
            min-height: 40px;
            margin: 6px 0;
        }

        .eh-card-body h3 a:hover {
            color: var(--blue);
        }

        .eh-card-body p {
            font-size: 17px;
            color: #1a3d65;
            font-weight: 800;
            margin: 9px 0 0;
        }

        .eh-footer {
            background: var(--navy);
            color: #ccd8eb;
            padding: 37px 0 24px;
        }

        .eh-footer-top {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 24px;
            padding-bottom: 25px;
        }

        .eh-footer .eh-brand-copy strong {
            color: white;
        }

        .eh-footer p {
            max-width: 380px;
            font-size: 12px;
            line-height: 1.7;
        }

        .eh-footer-nav {
            display: flex;
            gap: 18px;
            font-size: 12px;
        }

        .eh-footer-nav a:hover {
            color: white;
        }

        .eh-footer-bottom {
            padding-top: 20px;
            border-top: 1px solid #ffffff23;
            font-size: 11px;
            color: #a1b1c8;
        }

        .eh-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 100;
            border-radius: 10px;
            color: #fff;
            background: #10233b;
            padding: 14px 19px;
            font-size: 12px;
            box-shadow: 0 12px 40px #0e1d3c5c;
            opacity: 0;
            transform: translateY(12px);
            pointer-events: none;
            transition: .2s;
        }

        .eh-toast.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media(max-width:1000px) {
            .eh-detail {
                gap: 28px;
            }

            .eh-related-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media(max-width:750px) {
            .eh-detail {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .eh-related-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .eh-head-inner {
                gap: 16px;
            }

            .eh-head-links .eh-text {
                display: none;
            }
        }

        @media(max-width:640px) {
            .eh-container {
                width: calc(100% - 30px);
            }

            .eh-top .eh-container {
                justify-content: center;
                text-align: center;
            }

            .eh-top-right {
                display: none;
            }

            .eh-head-inner {
                flex-wrap: wrap;
                padding-block: 12px;
                gap: 12px;
                min-height: 72px;
            }

            .eh-brand-mark {
                width: 32px;
                height: 35px;
                font-size: 20px;
            }

            .eh-brand-copy strong {
                font-size: 19px;
            }

            .eh-search {
                order: 3;
                flex-basis: 100%;
                max-width: none;
            }

            .eh-head-links {
                margin-left: auto;
            }

            .eh-nav .eh-container {
                overflow-x: auto;
                gap: 24px;
                white-space: nowrap;
            }

            .eh-breadcrumbs {
                margin: 18px 0 20px;
            }

            .eh-main-image img {
                padding: 18px;
            }

            .eh-info h1 {
                font-size: 29px;
            }

            .eh-buyrow {
                gap: 9px;
            }

            .eh-detail-meta {
                padding: 15px;
            }

            .eh-related-grid {
                gap: 10px;
            }

            .eh-card-body {
                padding: 11px;
            }

            .eh-section-head {
                margin-top: 45px;
            }

            .eh-footer-top {
                flex-direction: column;
            }
        }

        @media(prefers-reduced-motion:reduce) {

            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }

@include('components.guest-shopping-guard');

    </style>
</head>

<body>
    @php
        // Use real uploaded image when available; otherwise a local illustrative SVG.
        $visuals = [
            'earbud' => 'earbuds',
            'headphone' => 'headphones',
            'keyboard' => 'keyboard',
            'mouse' => 'mouse',
            'power bank' => 'powerbank',
            'charger' => 'charger',
            'watch' => 'watch',
            'lamp' => 'lamp',
            'light' => 'lamp',
            'stand' => 'stand',
            'speaker' => 'speaker',
        ];
        $findImage = function ($item) use ($visuals) {
            if ($item->image) {
                return asset('storage/' . $item->image);
            }
            $filename = 'speaker';
            foreach ($visuals as $needle => $visual) {
                if (str_contains(strtolower($item->name), $needle)) {
                    $filename = $visual;
                    break;
                }
            }
            return asset('images/electrohub/' . $filename . '.svg');
        };
    @endphp
    <div class="eh-top">
        <div class="eh-container">
            <span>✦ ElectroHub — Modern tech, everyday essentials &nbsp; | &nbsp; Portfolio Demo Store</span>
            <span class="eh-top-right">Sample products & prices · No real purchases</span>
        </div>
    </div>
    <header class="eh-head">
        <div class="eh-container eh-head-inner">
            <a href="{{ route('home') }}" class="eh-brand" aria-label="ElectroHub Home">
                <span class="eh-brand-mark">E</span>
                <span class="eh-brand-copy"><strong>Electro<span>Hub</span></strong><small>Tech for Every
                        Day.</small></span>
            </a>
            <form class="eh-search" action="{{ route('shop.index') }}" method="GET" role="search">
                <input type="search" name="search" maxlength="100"
                    placeholder="Search for products, brands or more..." aria-label="Search products">
                <button type="submit" aria-label="Search">⌕</button>
            </form>

            <div style="margin: 14px 0 20px;">
                <x-wishlist-heart
                    :product="$product"
                    :showlabel="true"
                />
            </div>

            <div class="eh-head-links">
                <a href="{{ route('home') }}" title="Back to Home">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 10.5 12 3l9 7.5V21h-6v-6H9v6H3z" />
                    </svg>
                    <span class="eh-text">Home</span>
                </a>
                <a href="{{ route('cart.index') }}" title="View shopping cart">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.5 14h13l2.5-10H6" />
                    </svg>
                    <span class="eh-text">Cart</span> <span id="eh-cart-count" class="eh-cart-count">0</span>
                </a>
            </div>
        </div>
    </header>
    <nav class="eh-nav" aria-label="Main navigation">
        <div class="eh-container">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}" class="eh-current">Shop</a>
            <a href="{{ route('shop.index') }}#products">All Products</a>
            <a href="{{ route('home') }}#categories">Categories</a>
            <a href="{{ route('home') }}#offers">Special Offers</a>
        </div>
    </nav>
    <main class="eh-main eh-container">
        <div class="eh-breadcrumbs">
            <a href="{{ route('home') }}">Home</a><span>›</span>
            <a href="{{ route('shop.index') }}">Shop</a><span>›</span>
            <a
                href="{{ route('shop.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a><span>›</span>
            <span aria-current="page">{{ $product->name }}</span>
        </div>


        @if(session('success'))
            <div role="status"
                style="background:#e8f7ef;color:#17643b;
                        padding:15px;border-radius:10px;
                        margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div role="alert"
                style="background:#fff0f0;color:#b42318;
                        padding:15px;border-radius:10px;
                        margin-bottom:20px;">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="eh-detail" aria-labelledby="eh-product-title">
            <div>
                <div class="eh-main-image">
                    @if ($product->is_featured)
                        <span class="eh-badge">FEATURED</span>
                    @endif
                    <img src="{{ $findImage($product) }}" alt="{{ $product->name }}" width="800" height="700">
                </div>
                <p class="eh-thumb-note">Product image for demonstration purposes.</p>
            </div>
            <div class="eh-info">
                <span class="eh-label">{{ $product->category->name }}</span>
                <h1 id="eh-product-title">{{ $product->name }}</h1>
                <p class="eh-brandline">

                <p class="eh-brandline">

                    Brand:

                    @if($product->brand)

                        <a
                            href="{{ route('shop.index', ['brand' => $product->brand]) }}"
                            style="color:#2477ee;font-weight:800;"
                        >
                            {{ $product->brand }}
                        </a>

                    @else

                        <strong>Electronics</strong>

                    @endif

                </p>

                    <strong>{{ $product->brand ?: 'Electronics' }}</strong></p>
                <div class="eh-price">
                    ${{ number_format($product->price, 2) }}
                    @if ($product->compare_at_price && $product->compare_at_price > $product->price)
                        <span class="eh-old">${{ number_format($product->compare_at_price, 2) }}</span>
                    @endif
                </div>
                <hr class="eh-hr">
                <p class="eh-desc">
                    {{ $product->description ?: 'Explore this tech accessory, designed for your everyday routine.' }}
                </p>
                <div class="eh-stock {{ $product->stock > 0 ? '' : 'out' }}">
                    <span class="eh-dot" aria-hidden="true"></span>
                    {{ $product->stock > 0 ? 'In Stock · ' . $product->stock . ' available' : 'Out of Stock' }}
                </div>

                <form
                    action="{{ route('cart.add', $product->id) }}"
                    method="POST"
                    class="eh-buyrow"
                >
                    @csrf

                    <div class="eh-qty-wrap">
                        <label for="eh-quantity">Quantity</label>

                        <div class="eh-qty">
                            <button type="button" id="eh-minus">−</button>

                            <input
                                id="eh-quantity"
                                name="quantity"
                                type="number"
                                value="1"
                                min="1"
                                max="{{ min(10, max(1, $product->stock)) }}"
                                readonly
                                aria-label="Quantity"
                            >

                            <button type="button" id="eh-plus">+</button>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="eh-add"
                        id="eh-add"
                        @disabled($product->stock < 1)
                    >
                        {{ $product->stock > 0 ? '＋ Add to Cart' : 'Out of Stock' }}
                    </button>
                </form>

                <div class="eh-detail-meta">
                    <div><strong>Product ID</strong>#{{ $product->id }}</div>
                    <div><strong>Category</strong>{{ $product->category->name }}</div>
                    <div><strong>Availability</strong>{{ $product->stock > 0 ? 'Available' : 'Unavailable' }}</div>
                    <div><strong>Store</strong>ElectroHub Demo</div>
                </div>
            </div>
        </section>


        @if ($relatedProducts->isNotEmpty())

            <div class="eh-section-head">

                <h2>You May Also Like</h2>

                <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}">
                    View Category →
                </a>

            </div>

            <div class="eh-related-grid">

                @foreach ($relatedProducts as $related)

                    <article
                        class="eh-card"
                        style="position: relative;"
                    >

                        <!-- Product Image -->
                        <a
                            class="eh-card-photo"
                            href="{{ route('shop.show', ['product' => $related->slug]) }}"
                        >
                            <img
                                src="{{ $findImage($related) }}"
                                alt="{{ $related->name }}"
                                loading="lazy"
                                width="350"
                                height="300"
                            >
                        </a>

                        <!-- Wishlist Heart -->
                        <x-wishlist-heart
                            :product="$related"
                            :floating="true"
                        />

                        <!-- Product Information -->
                        <div class="eh-card-body">

                            <small>
                                {{ $related->brand ?: 'Electronics' }}
                            </small>

                            <h3>
                                <a href="{{ route('shop.show', ['product' => $related->slug]) }}">
                                    {{ $related->name }}
                                </a>
                            </h3>

                            <p>
                                ${{ number_format($related->price, 2) }}
                            </p>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </main>
    <footer class="eh-footer">
        <div class="eh-container">
            <div class="eh-footer-top">
                <div>
                    <a href="{{ route('home') }}" class="eh-brand">
                        <span class="eh-brand-mark">E</span>
                        <span class="eh-brand-copy"><strong>Electro<span>Hub</span></strong><small>Tech for Every
                                Day.</small></span>
                    </a>
                    <p>Modern electronics, smarter essentials. A portfolio demonstration built with Laravel & MySQL.</p>
                </div>
                <div class="eh-footer-nav">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('shop.index') }}">Shop</a>
                    <a href="{{ route('home') }}#categories">Categories</a>
                </div>
            </div>
            <div class="eh-footer-bottom">© 2026 ElectroHub. Portfolio Demo · No real purchases.</div>
        </div>
    </footer>
    <div class="eh-toast" id="eh-toast" role="status" aria-live="polite"></div>

    <script>
        const qtyInput = document.getElementById('eh-quantity');

        const maxQty = Math.min(
            10,
            Math.max(1, @json($product->stock))
        );

        document.getElementById('eh-minus')
            .addEventListener('click', () => {
                qtyInput.value = Math.max(
                    1,
                    Number(qtyInput.value) - 1
                );
            });

        document.getElementById('eh-plus')
            .addEventListener('click', () => {
                qtyInput.value = Math.min(
                    maxQty,
                    Number(qtyInput.value) + 1
                );
            });

        document.getElementById('eh-cart-count').textContent =
            @json(array_sum(session('cart', [])));
    </script>

</body>

</html>
