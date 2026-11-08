<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#101b31">
    <title>Shop All Products | ElectroHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #101b31;
            --navy2: #192746;
            --blue: #2477ee;
            --ink: #17233a;
            --muted: #748197;
            --border: #e8edf5;
            --soft: #f5f7fb;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: #fff;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
        }

        button,
        input,
        select {
            font: inherit;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            cursor: pointer;
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
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .eh-head {
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .eh-head-inner {
            min-height: 84px;
            display: flex;
            gap: 32px;
            align-items: center;
            justify-content: space-between;
        }

        .eh-brand {
            display: flex;
            flex: none;
            gap: 10px;
            align-items: center;
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

        .eh-head-links a,
        .eh-head-links button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 0;
            background: transparent;
            font-size: 12px;
            font-weight: 650;
            white-space: nowrap;
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
            align-items: center;
            gap: 30px;
            min-height: 47px;
            font-size: 12px;
            font-weight: 650;
        }

        .eh-nav a:hover,
        .eh-head-links a:hover {
            color: var(--blue);
        }

        .eh-nav .eh-current {
            color: var(--blue);
        }

        .eh-strip {
            background: linear-gradient(110deg, #101b31, #20385d);
            color: white;
            padding: 40px 0;
        }

        .eh-strip .eh-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
        }

        .eh-overline {
            display: block;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .21em;
            text-transform: uppercase;
            color: #8ab9ff;
            margin-bottom: 8px;
        }

        .eh-strip h1 {
            font-size: clamp(31px, 4vw, 44px);
            letter-spacing: -1px;
            margin: 0 0 8px;
            font-weight: 800;
        }

        .eh-strip p {
            color: #d0dceb;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }

        .eh-strip-icon {
            width: 84px;
            height: 84px;
            border: 1px solid #6786ad55;
            border-radius: 24px;
            display: grid;
            place-items: center;
            background: #ffffff0d;
            font-size: 45px;
        }

        .eh-breadcrumbs {
            display: flex;
            gap: 9px;
            padding: 23px 0 27px;
            color: #8591a3;
            font-size: 12px;
        }

        .eh-breadcrumbs a {
            color: #4d617a;
        }

        .eh-breadcrumbs a:hover {
            color: var(--blue);
        }

        .eh-layout {
            display: grid;
            grid-template-columns: 248px minmax(0, 1fr);
            gap: 31px;
            align-items: start;
            padding-bottom: 60px;
        }

        .eh-sidebar {
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 23px;
            background: #fff;
            box-shadow: 0 7px 22px #182a4707;
        }

        .eh-side-title {
            font-size: 15px;
            margin: 0 0 17px;
            font-weight: 800;
        }

        .eh-cats {
            display: grid;
            gap: 3px;
        }

        .eh-cat {
            display: flex;
            justify-content: space-between;
            gap: 7px;
            align-items: center;
            padding: 10px 12px;
            font-size: 12px;
            color: #56647b;
            border-radius: 8px;
        }

        .eh-cat:hover,
        .eh-cat.is-active {
            background: #edf4ff;
            color: #176ce0;
            font-weight: 700;
        }

        .eh-divider {
            border: 0;
            height: 1px;
            background: var(--border);
            margin: 21px 0;
        }

        .eh-label {
            display: block;
            margin: 0 0 9px;
            color: #384861;
            font-size: 12px;
            font-weight: 700;
        }

        .eh-select,
        .eh-input {
            border: 1px solid #dfe6f0;
            width: 100%;
            min-width: 0;
            outline: 0;
            border-radius: 8px;
            background: #fff;
            color: #273a55;
            padding: 10px;
            font-size: 12px;
        }

        .eh-select:focus,
        .eh-input:focus {
            border-color: #5599ee;
            box-shadow: 0 0 0 3px #2477ee12;
        }

        .eh-prices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
        }

        .eh-apply {
            border: 0;
            padding: 11px 17px;
            width: 100%;
            color: white;
            background: #2477ee;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 750;
            margin-top: 17px;
        }

        .eh-apply:hover {
            background: #1462d8;
        }

        .eh-clear {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: 12px;
            color: #718099;
        }

        .eh-clear:hover {
            color: #2477ee;
        }

        .eh-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 21px;
        }

        .eh-toolbar h2 {
            margin: 0 0 5px;
            font-size: 22px;
            letter-spacing: -.5px;
            font-weight: 800;
        }

        .eh-toolbar p {
            margin: 0;
            color: #8090a5;
            font-size: 12px;
        }

        .eh-sort {
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .eh-sort label {
            color: #718099;
            font-size: 12px;
        }

        .eh-sort select {
            width: 175px;
        }

        .eh-products {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 19px;
        }

        .eh-card {
            position: relative;
            cursor: pointer;
        }

        .eh-card-link {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .eh-card:focus-within {
            outline: 2px solid #2477ee;
            outline-offset: 3px;
        }

        .eh-btn-cart {
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .eh-product-img {
            position: relative;
            aspect-ratio: 1.18;
            background: #f5f8fc;
        }

        .eh-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .eh-tag {
            position: absolute;
            left: 10px;
            top: 10px;
            background: #e3f3ff;
            color: #186bd2;
            font-size: 9px;
            font-weight: 800;
            padding: 6px 8px;
            border-radius: 6px;
        }

        .eh-product-body {
            padding: 15px;
        }

        .eh-product-cat {
            font-size: 10px;
            font-weight: 650;
            color: #8290a4;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .eh-product-name {
            margin: 8px 0 6px;
            font-size: 14px;
            font-weight: 780;
            line-height: 1.5;
            min-height: 41px;
        }

        .eh-product-brand {
            font-size: 11px;
            color: #8490a2;
            margin-bottom: 10px;
        }

        .eh-price {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 8px;
            color: #1d3554;
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .eh-old-price {
            font-size: 12px;
            color: #a1abba;
            text-decoration: line-through;
            font-weight: 500;
        }

        .eh-btn-cart {
            border: 0;
            width: 100%;
            background: #2477ee;
            color: white;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 750;
        }

        .eh-btn-cart:hover {
            background: #1566df;
        }

        .eh-btn-cart:disabled {
            background: #d5dce5;
            color: #6d7c8e;
            cursor: not-allowed;
        }

        .eh-empty {
            padding: 65px 24px;
            border: 1px dashed #cedaeb;
            border-radius: 13px;
            background: #f8faff;
            text-align: center;
        }

        .eh-empty h3 {
            margin: 0 0 7px;
            font-size: 20px;
        }

        .eh-empty p {
            margin: 0 0 18px;
            font-size: 13px;
            color: #748197;
        }

        .eh-empty a {
            display: inline-block;
            padding: 11px 20px;
            background: #2477ee;
            color: #fff;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .eh-pagination {
            margin-top: 27px;
        }

        .eh-footer {
            background: #101b31;
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

        @media (max-width: 1100px) {
            .eh-head-inner {
                gap: 18px;
            }

            .eh-layout {
                grid-template-columns: 220px minmax(0, 1fr);
                gap: 18px;
            }

            .eh-products {
                gap: 12px;
            }
        }

        @media (max-width: 900px) {
            .eh-products {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .eh-head-links .eh-text {
                display: none;
            }

            .eh-head-inner {
                min-height: 72px;
            }

            .eh-nav .eh-container {
                gap: 20px;
            }
        }

        @media (max-width: 640px) {
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

            .eh-strip {
                padding: 32px 0;
            }

            .eh-strip-icon {
                display: none;
            }

            .eh-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .eh-sidebar {
                padding: 19px;
            }

            .eh-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .eh-products {
                gap: 10px;
            }

            .eh-product-body {
                padding: 10px;
            }

            .eh-product-name {
                font-size: 12px;
            }

            .eh-price {
                font-size: 16px;
            }

            .eh-footer-top {
                flex-direction: column;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
            }
        }

        .eh-card form {
            position: relative;
            z-index: 2;
        }

@include('components.guest-shopping-guard');

    </style>
</head>

<body>
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
                <input type="search" name="search" maxlength="100" value="{{ request('search') }}"
                    placeholder="Search for products, brands or more..." aria-label="Search products">
                <button type="submit" aria-label="Search">⌕</button>
            </form>
            <div class="eh-head-links">
                <a href="{{ route('home') }}" title="Back to Home">
                    <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 10.5 12 3l9 7.5V21h-6v-6H9v6H3z" />
                    </svg>
                    <span class="eh-text">Home</span>
                </a>
                <a href="{{ route('cart.index') }}" title="View shopping cart">
                    <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.5 14h13l2.5-10H6" />
                    </svg>
                    <span class="eh-text">Cart</span>
                    <span id="eh-cart-count" class="eh-cart-count">
                        {{ array_sum(session('cart', [])) }}
                    </span>
                </a>
            </div>
        </div>
    </header>

    <nav class="eh-nav" aria-label="Main navigation">
        <div class="eh-container">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}" class="eh-current" aria-current="page">Shop</a>
            <a href="{{ route('shop.index') }}#products">All Products</a>
            <a href="{{ route('home') }}#categories">Categories</a>
            <a href="{{ route('home') }}#offers">Special Offers</a>
        </div>
    </nav>

    <main>
        <section class="eh-strip">
            <div class="eh-container">
                <div>
                    <span class="eh-overline">THE ELECTROHUB COLLECTION</span>
                    <h1>Explore All Products</h1>
                    <p>Find your next everyday tech essential. Discover audio, accessories, and smart gadgets.</p>
                </div>
                <div class="eh-strip-icon" aria-hidden="true">🎧</div>
            </div>
        </section>

        <div class="eh-container">
            <div class="eh-breadcrumbs"><a href="{{ route('home') }}">Home</a> <span>›</span> <span>Shop</span></div>

            @if(session('success'))
                <div style="background:#e8f7ef; color:#17643b;
                            padding:15px; border-radius:10px;
                            margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:#fff0f0; color:#b42318;
                            padding:15px; border-radius:10px;
                            margin-bottom:20px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="eh-layout" id="products">
                <aside class="eh-sidebar" aria-label="Shop filters">
                    <h2 class="eh-side-title">Product Categories</h2>
                    <div class="eh-cats">
                        <a class="eh-cat {{ request('category') ? '' : 'is-active' }}"
                            href="{{ route('shop.index', request()->except('category', 'page')) }}">All Categories
                            <span>→</span></a>
                        @foreach ($categories as $category)
                            <a class="eh-cat {{ request('category') === $category->slug ? 'is-active' : '' }}"
                                href="{{ route('shop.index', array_merge(request()->except('category', 'page'), ['category' => $category->slug])) }}">
                                {{ $category->name }} <span>›</span>
                            </a>
                        @endforeach
                    </div>

                    <hr class="eh-divider">
                    <form action="{{ route('shop.index') }}" method="GET" id="eh-filter-form">
                        @if (request()->filled('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request()->filled('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <label class="eh-label" for="eh-brand">Brand</label>
                        <select class="eh-select" id="eh-brand" name="brand">
                            <option value="">All Brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand }}" @selected(request('brand') === $brand)>{{ $brand }}
                                </option>
                            @endforeach
                        </select>

                        <hr class="eh-divider">
                        <label class="eh-label">Price Range ($)</label>
                        <div class="eh-prices">
                            <input class="eh-input" name="min_price" type="number" min="0" step="0.01"
                                placeholder="Min" value="{{ request('min_price') }}" aria-label="Minimum price">
                            <input class="eh-input" name="max_price" type="number" min="0" step="0.01"
                                placeholder="Max" value="{{ request('max_price') }}" aria-label="Maximum price">
                        </div>
                        <button class="eh-apply" type="submit">Apply Filters</button>
                        <a class="eh-clear" href="{{ route('shop.index') }}">Clear All Filters</a>
                    </form>
                </aside>

                <section aria-labelledby="eh-products-heading">
                    <div class="eh-toolbar">
                        <div>
                            <h2 id="eh-products-heading">All Products</h2>
                            <p>Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of
                                {{ $products->total() }} products</p>
                        </div>
                        <form class="eh-sort" action="{{ route('shop.index') }}" method="GET">
                            @foreach (request()->except('sort', 'page') as $key => $value)
                                @if (is_scalar($value) && $value !== '')
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <label for="eh-sort-by">Sort:</label>
                            <select class="eh-select" id="eh-sort-by" name="sort" onchange="this.form.submit()">
                                <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest First</option>
                                <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                                <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                            </select>
                            <noscript><button type="submit">Sort</button></noscript>
                        </form>
                    </div>

                    @if ($products->count())
                        <div class="eh-products">
                            @foreach ($products as $product)
                                @php
                                    $nameLower = strtolower($product->name);
                                    $imageName = match (true) {
                                        str_contains($nameLower, 'earbud') => 'earbuds',
                                        str_contains($nameLower, 'headphone') => 'headphones',
                                        str_contains($nameLower, 'keyboard') => 'keyboard',
                                        str_contains($nameLower, 'mouse') => 'mouse',
                                        str_contains($nameLower, 'power bank') => 'powerbank',
                                        str_contains($nameLower, 'charger') => 'charger',
                                        str_contains($nameLower, 'watch') => 'watch',
                                        str_contains($nameLower, 'lamp') || str_contains($nameLower, 'light') => 'lamp',
                                        str_contains($nameLower, 'stand') => 'stand',
                                        default => 'speaker',
                                    };
                                    $productImage = $product->image
                                        ? asset('storage/' . $product->image)
                                        : asset('images/electrohub/' . $imageName . '.svg');
                                    $remotePhotos = [
                                        'headphones' => 'photo-1583394838336-acd977736f90',
                                        'earbuds' => 'photo-1572569511254-d8f925fe2cbb',
                                        'keyboard' => 'photo-1587829741301-dc798b83add3',
                                        'mouse' => 'photo-1527814050087-3793815479db',
                                        'powerbank' => 'photo-1678851836066-dc27614cc56b',
                                        'charger' => 'photo-1618478594486-c65b899c4931',
                                        'watch' => 'photo-1523275335684-37898b6baf30',
                                        'lamp' => 'photo-1507473885765-e6ed057f782c',
                                    ];
                                    $remotePhoto =
                                        !$product->image && isset($remotePhotos[$imageName])
                                            ? 'https://images.unsplash.com/' .
                                                $remotePhotos[$imageName] .
                                                '?auto=format&fit=crop&w=680&q=82'
                                            : null;
                                @endphp
                                <article class="eh-card">
                                    <a
                                        href="{{ route('shop.show', ['product' => $product->slug]) }}"
                                        class="eh-card-link"
                                        aria-label="View details of {{ $product->name }}">
                                    </a>
                                    <div class="eh-product-img">
                                        <img src="{{ $productImage }}"
                                            @if ($remotePhoto) data-remote="{{ $remotePhoto }}" @endif
                                            alt="{{ $product->name }}" loading="lazy" width="600"
                                            height="500">
                                        @if ($product->is_featured)
                                            <span class="eh-tag">FEATURED</span>
                                        @endif
                                        <!-- New Wishlist Heart -->
                                        <x-wishlist-heart
                                            :product="$product"
                                            :floating="true"
                                        />
                                    </div>
                                    <div class="eh-product-body">
                                        <div class="eh-product-cat">{{ $product->category->name }}</div>
                                        <h3 class="eh-product-name">
                                            <h3 class="eh-product-name">{{ $product->name }}</h3>
                                        </h3>
                                        <div class="eh-product-brand">{{ $product->brand ?: 'Electronics' }}</div>
                                        <div class="eh-price">
                                            ${{ number_format($product->price, 2) }}
                                            @if ($product->compare_at_price && $product->compare_at_price > $product->price)
                                                <span
                                                    class="eh-old-price">${{ number_format($product->compare_at_price, 2) }}</span>
                                            @endif
                                        </div>

                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="quantity" value="1">

                                            <button
                                                type="submit"
                                                class="eh-btn-cart"
                                                @disabled($product->stock < 1)
                                            >
                                                {{ $product->stock > 0 ? '＋ Add to Cart' : 'Out of Stock' }}
                                            </button>
                                        </form>

                                    </div>
                                </article>
                            @endforeach
                        </div>
                        @if ($products->hasPages())
                            <div class="eh-pagination">{{ $products->links() }}</div>
                        @endif
                    @else
                        <div class="eh-empty">
                            <h3>No products found</h3>
                            <p>Try another keyword, category, or price range.</p>
                            <a href="{{ route('shop.index') }}">View All Products</a>
                        </div>
                    @endif
                </section>
            </div>
        </div>
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
        document.querySelectorAll(
            '.eh-product-img img[data-remote]'
        ).forEach(img => {

            const photo = new Image();

            photo.onload = () => {
                if (img.isConnected) {
                    img.src = photo.src;
                }
            };

            photo.src = img.dataset.remote;
        });
    </script>

</body>

</html>
