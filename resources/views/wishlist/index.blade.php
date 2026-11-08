
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>My Wishlist | ElectroHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #17233a;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
            cursor: pointer;
        }

        .wl-container {
            width: min(1180px, calc(100% - 34px));
            margin: 0 auto;
        }

        .wl-header {
            background: white;
            border-bottom: 1px solid #e4ebf5;
        }

        .wl-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 23px 0;
        }

        .wl-brand {
            color: #101b31;
            font-size: 23px;
            font-weight: 850;
            letter-spacing: -1px;
        }

        .wl-brand span {
            color: #2477ee;
        }

        .wl-links {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            align-items: center;
            font-size: 12px;
            font-weight: 700;
        }

        .wl-links a:hover {
            color: #2477ee;
        }

        .wl-hero {
            padding: 47px 0 32px;
        }

        .wl-eyebrow {
            color: #2477ee;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        h1 {
            margin: 12px 0;
            font-size: 34px;
            letter-spacing: -1.2px;
        }

        .wl-description {
            font-size: 13px;
            color: #748197;
            line-height: 1.8;
        }

        .wl-count {
            display: inline-block;
            margin-top: 12px;
            padding: 9px 14px;
            border-radius: 20px;
            background: #e8f1ff;
            color: #2477ee;
            font-size: 12px;
            font-weight: 750;
        }

        .wl-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            padding-bottom: 45px;
        }

        .wl-card {
            overflow: hidden;
            background: white;
            border: 1px solid #e5ebf5;
            border-radius: 14px;
            box-shadow: 0 8px 28px #192b4510;
        }

        .wl-image {
            height: 210px;
            background: #eef3fa;
            display: grid;
            place-items: center;
            color: #7e8da3;
            font-size: 40px;
        }

        .wl-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wl-body {
            padding: 20px;
        }

        .wl-category {
            color: #7990aa;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .8px;
        }

        .wl-name {
            font-size: 15px;
            margin: 10px 0;
            line-height: 1.5;
            min-height: 45px;
        }

        .wl-price {
            font-size: 19px;
            font-weight: 850;
            color: #101b31;
            margin-bottom: 17px;
        }

        .wl-btn {
            display: block;
            width: 100%;
            border: 0;
            border-radius: 9px;
            padding: 12px;
            text-align: center;
            font-size: 12px;
            font-weight: 750;
        }

        .wl-primary {
            background: #2477ee;
            color: #fff;
        }

        .wl-primary:hover {
            background: #165cc4;
        }

        .wl-primary:disabled {
            background: #a9b8c9;
            cursor: not-allowed;
        }

        .wl-remove {
            background: #fff0f3;
            color: #d84360;
            margin-top: 9px;
        }

        .wl-remove:hover {
            background: #ffe3e9;
        }

        .wl-alert {
            background: #eaf8ef;
            color: #16804a;
            border: 1px solid #c5e8d2;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .wl-empty {
            padding: 65px 25px;
            text-align: center;
            background: white;
            border: 1px solid #e5ebf5;
            border-radius: 16px;
            margin-bottom: 50px;
        }

        .wl-empty-icon {
            font-size: 55px;
            color: #2477ee;
        }

        .wl-empty h2 {
            font-size: 22px;
        }

        .wl-empty p {
            color: #748197;
            font-size: 13px;
        }

        .wl-browse {
            display: inline-block;
            background: #2477ee;
            color: white;
            padding: 13px 24px;
            border-radius: 9px;
            margin-top: 15px;
            font-size: 12px;
            font-weight: 750;
        }

        .wl-footer {
            padding: 30px 15px;
            border-top: 1px solid #e5ebf5;
            text-align: center;
            color: #8190a3;
            font-size: 11px;
        }

        @media(max-width: 1050px) {
            .wl-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width: 750px) {
            .wl-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .wl-image {
                height: 160px;
            }

            .wl-body {
                padding: 13px;
            }

            h1 {
                font-size: 28px;
            }
        }

        @media(max-width: 440px) {
            .wl-grid {
                grid-template-columns: 1fr;
            }

            .wl-image {
                height: 220px;
            }
        }
    </style>

    @vite('resources/js/admin-confirm.js')

</head>

<body>

<header class="wl-header">
    <div class="wl-container wl-nav">

        <a href="{{ route('home') }}"
           class="wl-brand">
            Electro<span>Hub</span>
        </a>

        <nav class="wl-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}">Shop</a>
            <a href="{{ route('cart.index') }}">Cart</a>
            <a href="{{ route('profile.edit') }}">My Profile</a>
        </nav>

    </div>
</header>

<main class="wl-container">

    <section class="wl-hero">

        <span class="wl-eyebrow">
            YOUR FAVORITES
        </span>

        <h1>My Wishlist ♡</h1>

        <p class="wl-description">
            All your favorite tech accessories in one place.
            Save now and add to cart whenever you're ready.
        </p>

        <span class="wl-count">
            {{ $wishlists->total() }} Saved Products
        </span>

    </section>

    @if(session('success'))
        <div class="wl-alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('success'))
        <div
            id="admin-flash-success"
            data-message="{{ session('success') }}"
            hidden>
        </div>
    @endif

    @if($errors->any())
        <div class="wl-alert" style="background:#fff0f3;color:#bb3451">
            {{ $errors->first() }}
        </div>
    @endif

    @if($wishlists->count())

        <div class="wl-grid">

            @foreach($wishlists as $saved)

                @php
                    $product = $saved->product;
                @endphp

                @if($product)

                    <article class="wl-card">

                        <div class="wl-image">

                            @if($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                <span aria-hidden="true">⌨</span>
                            @endif

                        </div>

                        <div class="wl-body">

                            <div class="wl-category">
                                {{ $product->category?->name ?? 'Electronics' }}
                            </div>

                            <h2 class="wl-name">
                                {{ $product->name }}
                            </h2>

                            <div class="wl-price">
                                ${{ number_format(
                                    (float) $product->price,
                                    2
                                ) }}
                            </div>

                            <form
                                method="POST"
                                action="{{ route('cart.add', $product) }}"
                            >
                                @csrf

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button
                                    type="submit"
                                    class="wl-btn wl-primary"
                                    @disabled(
                                        !$product->is_active
                                        || $product->stock < 1
                                    )
                                >
                                    {{ $product->is_active && $product->stock > 0
                                        ? 'Add to Cart'
                                        : 'Unavailable' }}
                                </button>

                            </form>


                            <form
                                method="POST"
                                action="{{ route('wishlist.destroy', $product) }}"
                                data-confirm="Remove from Wishlist?"
                                data-confirm-text="Are you sure you want to remove this product from your wishlist?"
                                data-confirm-icon="warning"
                                data-confirm-button="Yes, Remove"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="wl-btn wl-remove"
                                >
                                    Remove ♡
                                </button>
                            </form>


                        </div>

                    </article>

                @endif

            @endforeach

        </div>

        <div style="margin:0 0 40px">
            {{ $wishlists->links() }}
        </div>

    @else

        <section class="wl-empty">

            <div class="wl-empty-icon">♡</div>

            <h2>Your Wishlist Is Empty</h2>

            <p>
                Browse ElectroHub and tap the heart
                on products you like.
            </p>

            <a href="{{ route('home') }}"
               class="wl-browse">
                Explore Products
            </a>

        </section>

    @endif

</main>

<footer class="wl-footer">
    © {{ date('Y') }} ElectroHub.
    Portfolio Demo Store.
</footer>

</body>
</html>
