
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin') | ElectroHub</title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/admin-confirm.js'
    ])


    <style>
        :root {
            --navy: #101b31;
            --navy2: #192746;
            --blue: #2477ee;
            --text: #17233a;
            --muted: #718099;
            --border: #e6edf6;
            --soft: #f5f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--soft);
            color: var(--text);
            font-family: Inter, system-ui, Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex: none;
            background: var(--navy);
            color: white;
            padding: 30px 18px;
        }

        .brand {
            display: block;
            font-size: 24px;
            font-weight: 850;
            letter-spacing: -1px;
            margin: 0 0 9px 12px;
        }

        .brand span {
            color: #68abff;
        }

        .brand-caption {
            font-size: 11px;
            color: #91a5c3;
            margin: 0 0 35px 12px;
        }

        .sidebar-label {
            font-size: 10px;
            color: #8194b1;
            font-weight: 800;
            letter-spacing: 1.4px;
            margin: 20px 12px 11px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            margin-bottom: 5px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 650;
            color: #c5d2e6;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background: #2477ee;
        }

        .nav-symbol {
            width: 21px;
            font-size: 17px;
            text-align: center;
        }

        .admin-main {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            min-height: 78px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 18px 32px;
        }

        .topbar-title {
            font-size: 13px;
            font-weight: 750;
        }

        .topbar-user {
            color: var(--muted);
            font-size: 12px;
        }

        .content {
            max-width: 1480px;
            margin: 0 auto;
            padding: 35px 32px 65px;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        h1 {
            font-size: 29px;
            letter-spacing: -.8px;
            margin: 0 0 8px;
        }

        h2 {
            font-size: 17px;
            margin: 0 0 9px;
        }

        .muted {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 7px 28px #182b4810;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat {
            padding: 24px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .stat-icon {
            color: var(--blue);
            background: #eaf2ff;
            width: 41px;
            height: 41px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .stat-value {
            font-size: 27px;
            font-weight: 850;
            margin-bottom: 7px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            text-align: left;
        }

        th {
            background: #f5f8fe;
            padding: 15px 13px;
            color: #62738c;
            font-weight: 750;
            white-space: nowrap;
        }

        td {
            padding: 15px 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .btn {
            display: inline-block;
            border: 0;
            background: var(--blue);
            color: white;
            border-radius: 8px;
            padding: 11px 15px;
            font-size: 12px;
            font-weight: 750;
            cursor: pointer;
            text-align: center;
            white-space: nowrap;
        }

        .btn:hover {
            background: #175fc9;
        }

        .btn-light {
            background: #eaf2ff;
            color: #206bd9;
        }

        .btn-light:hover {
            background: #dceaff;
        }

        .btn-danger {
            background: #fff0f2;
            color: #c03950;
        }

        .btn-danger:hover {
            background: #ffe0e5;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .input {
            width: 100%;
            min-width: 0;
            border: 1px solid #dce5f1;
            border-radius: 9px;
            padding: 12px 13px;
            background: white;
            color: var(--text);
            outline: none;
            font-size: 13px;
        }

        .input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px #2477ee13;
        }

        textarea.input {
            min-height: 105px;
            resize: vertical;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 17px;
        }

        .full {
            grid-column: 1 / -1;
        }

        .check {
            display: flex;
            gap: 9px;
            align-items: center;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .error {
            color: #c53b50;
            font-size: 11px;
            margin-top: 6px;
        }

        .alert {
            border: 1px solid #c7e9d3;
            background: #edfaf2;
            color: #16804a;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .alert-danger {
            border-color: #f4c7cf;
            background: #fff1f3;
            color: #ba3b4c;
        }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 10px;
            background: #eaf2ff;
            color: #246cd0;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status.pending {
            background: #fff1d9;
            color: #92631b;
        }

        .status.completed,
        .status.active {
            background: #e8f8ed;
            color: #16834d;
        }

        .status.cancelled,
        .status.inactive {
            background: #ffecef;
            color: #bd4056;
        }

        .thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            background: #edf3fc;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .pagination {
            margin-top: 22px;
        }

        @media (max-width: 1050px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar {
                width: 215px;
            }
        }

        @media (max-width: 750px) {
            .admin-shell {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 20px 15px;
            }

            .sidebar-label,
            .brand-caption {
                display: none;
            }

            .brand {
                margin: 0 0 15px;
            }

            .sidebar-nav {
                display: flex;
                gap: 6px;
                overflow-x: auto;
            }

            .nav-link {
                flex: none;
                padding: 10px;
            }

            .topbar {
                padding: 15px 18px;
            }

            .content {
                padding: 25px 17px 45px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                gap: 10px;
            }

            .stat {
                padding: 18px;
            }

            .stat-value {
                font-size: 23px;
            }

            .card {
                padding: 18px;
            }
        }

        .admin-account {
            margin-left: auto;
            position: relative;
        }

        .admin-user-menu {
            position: relative;
        }

        .admin-user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 12px;
            background: #f5f8fd;
            border: 1px solid #e5ebf4;
            border-radius: 10px;
            cursor: pointer;
            list-style: none;
            transition: background .2s;
        }

        .admin-user-trigger::-webkit-details-marker {
            display: none;
        }

        .admin-user-trigger::marker {
            content: "";
        }

        .admin-user-trigger:hover {
            background: #edf4ff;
        }

        .admin-user-trigger:focus-visible {
            outline: 2px solid #2477ee;
            outline-offset: 3px;
        }

        .admin-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e2edff;
            color: #2477ee;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .admin-user-name {
            font-size: 12px;
            font-weight: 750;
            color: #17233a;
            max-width: 145px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .admin-chevron {
            color: #718099;
            transition: transform .2s;
        }

        .admin-user-menu[open] .admin-chevron {
            transform: rotate(180deg);
        }

        /* Dropdown Menu */

        .admin-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 230px;
            max-width: calc(100vw - 24px);
            background: #ffffff;
            border: 1px solid #e5ebf4;
            border-radius: 12px;
            box-shadow: 0 14px 38px rgba(16, 27, 49, .15);
            padding: 8px;
            z-index: 100;
        }

        .admin-dropdown-header {
            padding: 11px 12px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .admin-dropdown-header strong {
            font-size: 12px;
            color: #17233a;
        }

        .admin-dropdown-header small {
            font-size: 11px;
            color: #718099;
            overflow-wrap: anywhere;
        }

        .admin-dropdown-divider {
            height: 1px;
            background: #edf0f5;
            margin: 5px 0;
        }

        .admin-dropdown-item {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #25334c;
            font-size: 12px;
            font-weight: 650;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        }

        .admin-dropdown-item:hover {
            background: #edf4ff;
            color: #2477ee;
        }

        .admin-dropdown form {
            margin: 0;
        }

        .admin-dropdown-item.logout-item {
            color: #d84460;
        }

        .admin-dropdown-item.logout-item:hover {
            background: #fff0f3;
            color: #bd324e;
        }

        @media (max-width: 600px) {
            .admin-user-name {
                max-width: 85px;
            }

            .admin-user-trigger {
                padding: 6px 8px;
                gap: 6px;
            }
        }

    </style>
</head>

<body>

<div class="admin-shell">

    <aside class="sidebar">

        <a href="{{ route('admin.dashboard') }}"
           class="brand">
            Electro<span>Hub</span>
        </a>

        <p class="brand-caption">STORE ADMINISTRATION</p>

        <div class="sidebar-label">MANAGEMENT</div>

        <nav class="sidebar-nav">

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-symbol">▦</span>
                Dashboard
            </a>

            
            @if(
                auth()->user()->role === 'admin' &&
                config('electrohub_admin.owner_email') &&
                strcasecmp(
                    auth()->user()->email,
                    (string) config('electrohub_admin.owner_email')
                ) === 0
            )
                <a
                    href="{{ route('admin.admins.index') }}"
                    class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}"
                >
                    <span class="nav-symbol">🛡</span>
                    Admin Management
                </a>
            @endif

            
@if(
    auth()->user()->role === 'admin' &&
    config('electrohub_admin.owner_email') &&
    strcasecmp(
        auth()->user()->email,
        (string) config('electrohub_admin.owner_email')
    ) === 0
)
    <a
        href="{{ route('admin.activity-logs.index') }}"
        class="nav-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}"
    >
        <span class="nav-symbol">◷</span>
        Activity Log
    </a>
@endif


            <a href="{{ route('admin.products.index') }}"
               class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="nav-symbol">◈</span>
                Products
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-symbol">▤</span>
                Categories
            </a>

            <a href="{{ route('admin.brands.index') }}"
            class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <span class="nav-symbol">◈</span>
                <span>Brands</span>
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="nav-symbol">▣</span>
                Orders
            </a>

            <a href="{{ route('admin.wishlists.index') }}"
            class="nav-link {{ request()->routeIs('admin.wishlists.*') ? 'active' : '' }}">
                <span class="nav-symbol">♡</span>
                Wishlists
            </a>


        </nav>

        <div class="sidebar-label">STOREFRONT</div>

        <nav class="sidebar-nav">
            <a href="{{ route('home') }}"
               class="nav-link">
                <span class="nav-symbol">⌂</span>
                Visit Store
            </a>
        </nav>

    </aside>

    <div class="admin-main">

        <header class="topbar">
            <div class="topbar-title">
                ElectroHub Admin Panel
            </div>


<div class="admin-account">

    <details class="admin-user-menu" id="admin-user-menu">

        <summary class="admin-user-trigger">

            <span class="admin-user-avatar">
                <svg width="19" height="19"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <circle cx="12" cy="8" r="4"/>

                    <path d="M4 21v-2a8 8 0 0 1 16 0v2"/>

                </svg>
            </span>

            <span class="admin-user-name">
                {{ auth()->user()->name }}
            </span>

            <svg class="admin-chevron"
                 width="15"
                 height="15"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="m6 9 6 6 6-6"/>

            </svg>

        </summary>

        <div class="admin-dropdown">

            <div class="admin-dropdown-header">
                <strong>{{ auth()->user()->name }}</strong>

                <small>
                    {{ auth()->user()->email }}
                </small>
            </div>

            <div class="admin-dropdown-divider"></div>

            <a href="{{ route('profile.edit') }}"
               class="admin-dropdown-item">

                <span>My Profile</span>

            </a>

            <div class="admin-dropdown-divider"></div>

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="admin-dropdown-item logout-item">

                    Logout

                </button>

            </form>

        </div>

    </details>

</div>

        </header>

        <main class="content">


        @if(session('success'))
            <div
                id="admin-flash-success"
                data-message="{{ session('success') }}"
                hidden>
            </div>
        @endif

        @if($errors->any())
            <div
                id="admin-flash-error"
                data-message="{{ $errors->first() }}"
                hidden>
            </div>
        @endif


            @yield('content')

        </main>

    </div>
</div>


<script>
    document.addEventListener('click', function (event) {
        const menu = document.getElementById('admin-user-menu');

        if (menu && menu.open && !menu.contains(event.target)) {
            menu.open = false;
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const menu = document.getElementById('admin-user-menu');

            if (menu && menu.open) {
                menu.open = false;
                menu.querySelector('summary').focus();
            }
        }
    });
</script>

</body>
</html>
