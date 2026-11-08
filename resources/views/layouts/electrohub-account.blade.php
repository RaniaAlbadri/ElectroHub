
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title', 'My Account') | ElectroHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy: #101b31;
            --blue: #2477ee;
            --text: #17233a;
            --muted: #718099;
            --border: #e5ebf4;
            --soft: #f5f7fb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--soft);
            color: var(--text);
            font-family: Inter, system-ui, Arial, sans-serif;
        }

        a { color: inherit; text-decoration: none; }

        button, input { font: inherit; }

        .eh-topbar {
            background: var(--navy);
            color: #d4e0ee;
            padding: 10px 15px;
            text-align: center;
            font-size: 11px;
        }

        .eh-header {
            background: white;
            border-bottom: 1px solid var(--border);
        }

        .eh-container {
            width: min(1120px, calc(100% - 36px));
            margin: 0 auto;
        }

        .eh-navbar {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding: 12px 0;
        }

        .eh-logo {
            color: var(--navy);
            font-size: 25px;
            font-weight: 850;
            letter-spacing: -1px;
            white-space: nowrap;
        }

        .eh-logo span { color: var(--blue); }

        .eh-navlinks {
            display: flex;
            align-items: center;
            gap: 19px;
            flex-wrap: wrap;
            font-size: 12px;
            font-weight: 650;
        }

        .eh-navlinks a:hover { color: var(--blue); }

        .eh-logout {
            background: #edf4ff;
            border: 0;
            border-radius: 8px;
            color: #1d67ce;
            padding: 9px 13px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .eh-main {
            padding-top: 42px;
            padding-bottom: 75px;
            min-height: 70vh;
        }

        .eh-crumb {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 19px;
        }

        .eh-crumb a:hover { color: var(--blue); }

        .eh-heading {
            margin-bottom: 26px;
        }

        .eh-heading h1 {
            font-size: clamp(28px, 3.5vw, 38px);
            margin: 0 0 8px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .eh-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        .eh-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .eh-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 27px;
            box-shadow: 0 10px 32px #192c4710;
            min-width: 0;
        }

        .eh-card h2 {
            font-size: 18px;
            margin: 0 0 8px;
            letter-spacing: -.3px;
            font-weight: 800;
        }

        .eh-subtitle {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin: 0 0 25px;
        }

        .eh-field {
            margin-bottom: 18px;
        }

        .eh-field label {
            display: block;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .eh-input {
            width: 100%;
            min-width: 0;
            background: white;
            border: 1px solid #dce5f1;
            border-radius: 9px;
            padding: 13px 14px;
            color: var(--text);
            font-size: 13px;
            outline: none;
        }

        .eh-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px #2477ee17;
        }

        .eh-error {
            color: #c83e51;
            font-size: 11px;
            margin-top: 7px;
        }

        .eh-btn {
            display: inline-block;
            background: var(--blue);
            border: 0;
            border-radius: 9px;
            color: white;
            padding: 12px 19px;
            font-size: 12px;
            font-weight: 750;
            cursor: pointer;
            text-align: center;
        }

        .eh-btn:hover { background: #185fc6; }

        .eh-btn-secondary {
            background: #edf4ff;
            color: #1c67ce;
        }

        .eh-btn-secondary:hover { background: #deebff; }

        .eh-btn-danger {
            background: #cf4053;
        }

        .eh-btn-danger:hover { background: #b22d41; }

        .eh-alert {
            background: #ecf9f0;
            border: 1px solid #c6ead2;
            border-radius: 10px;
            padding: 13px 17px;
            color: #187548;
            font-size: 12px;
            margin-bottom: 22px;
        }

        .eh-alert-error {
            background: #fff0f2;
            border-color: #f5c9d0;
            color: #ad3246;
        }

        .eh-link {
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
        }

        .eh-table-wrap {
            overflow-x: auto;
        }

        .eh-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            text-align: left;
        }

        .eh-table th {
            background: #f5f8fe;
            color: #60728b;
            font-weight: 750;
            padding: 15px 14px;
            white-space: nowrap;
        }

        .eh-table td {
            border-bottom: 1px solid var(--border);
            padding: 17px 14px;
            vertical-align: middle;
        }

        .eh-table tr:last-child td {
            border-bottom: 0;
        }

        .eh-status {
            display: inline-block;
            border-radius: 20px;
            padding: 7px 11px;
            background: #fff4dc;
            color: #946312;
            font-size: 11px;
            font-weight: 750;
            text-transform: capitalize;
        }

        .eh-status.completed {
            background: #e5f8ed;
            color: #148653;
        }

        .eh-status.cancelled {
            background: #ffeaed;
            color: #bd3a50;
        }

        .eh-empty {
            text-align: center;
            padding: 55px 20px;
        }

        .eh-empty-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            margin: 0 auto 17px;
            display: grid;
            place-items: center;
            background: #eaf2ff;
            color: var(--blue);
            font-size: 30px;
        }

        .eh-summary {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .eh-summary:last-child {
            border-bottom: 0;
        }

        .eh-muted { color: var(--muted); }

        .eh-footer {
            background: var(--navy);
            color: #cbd6e7;
            padding: 25px 0;
            font-size: 11px;
        }

        .eh-footer .eh-container {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        @media (max-width: 750px) {
            .eh-grid { grid-template-columns: 1fr; }
            .eh-navbar { justify-content: center; }
            .eh-card { padding: 21px; }
            .eh-main { padding-top: 28px; }
            .eh-navlinks { justify-content: center; gap: 13px; }
        }
    </style>
</head>
<body>

    <div class="eh-topbar">
        ElectroHub — Modern Tech · Portfolio Demo Store
    </div>

    <header class="eh-header">
        <div class="eh-container eh-navbar">

            <a class="eh-logo" href="{{ route('home') }}">
                Electro<span>Hub</span>
            </a>

            <nav class="eh-navlinks" aria-label="Account navigation">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop.index') }}">Shop</a>
                <a href="{{ route('cart.index') }}">Cart</a>
                <a href="{{ route('profile.edit') }}">My Profile</a>
                <a href="{{ route('orders.index') }}">My Orders</a>

                <form method="POST"
                      action="{{ route('logout') }}"
                      style="margin:0">
                    @csrf
                    <button type="submit" class="eh-logout">
                        Logout
                    </button>
                </form>
            </nav>

        </div>
    </header>

    <main class="eh-container eh-main">

        @if (session('success'))
            <div class="eh-alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

    <footer class="eh-footer">
        <div class="eh-container">
            <strong>ElectroHub</strong>
            <span>Laravel · MySQL · Modern Tech Portfolio</span>
        </div>
    </footer>

</body>
</html>
