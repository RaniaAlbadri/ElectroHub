
@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<style>
    .sales-kpis {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 26px;
    }

    .sales-kpi {
        background: #fff;
        border: 1px solid #e6edf6;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 7px 28px #182b4810;
        min-width: 0;
    }

    .sales-kpi-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 19px;
    }

    .sales-kpi-label {
        color: #718099;
        font-size: 12px;
        font-weight: 650;
    }

    .sales-kpi-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #eaf2ff;
        color: #2477ee;
        display: grid;
        place-items: center;
        font-size: 19px;
    }

    .sales-kpi-amount {
        font-size: clamp(22px, 2.5vw, 31px);
        font-weight: 850;
        letter-spacing: -1px;
        color: #101b31;
        overflow-wrap: anywhere;
    }

    .sales-kpi-note {
        font-size: 11px;
        color: #8a97aa;
        margin-top: 10px;
    }

    .sales-chart-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .sales-chart-card {
        background: white;
        border: 1px solid #e6edf6;
        border-radius: 15px;
        padding: 24px;
        box-shadow: 0 7px 28px #182b4810;
        min-width: 0;
    }

    .sales-chart-card.wide {
        grid-column: 1 / -1;
    }

    .sales-chart-head {
        display: flex;
        align-items: start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 23px;
    }

    .sales-chart-head h2 {
        font-size: 17px;
        font-weight: 800;
        margin: 0 0 7px;
    }

    .sales-chart-head p {
        color: #718099;
        font-size: 12px;
        margin: 0;
    }

    .sales-chart-tag {
        background: #edf4ff;
        color: #2477ee;
        padding: 7px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 750;
        white-space: nowrap;
    }

    .sales-chart-container {
        position: relative;
        height: 310px;
        width: 100%;
    }

    .sales-chart-container canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .sales-disclaimer {
        color: #718099;
        font-size: 11px;
        line-height: 1.6;
        margin: 0 0 27px;
    }

    @media(max-width: 980px) {
        .sales-kpis {
            gap: 12px;
        }

        .sales-kpi {
            padding: 18px;
        }

        .sales-chart-grid {
            grid-template-columns: 1fr;
        }

        .sales-chart-card.wide {
            grid-column: auto;
        }
    }

    @media(max-width: 600px) {
        .sales-kpis {
            grid-template-columns: 1fr;
        }

        .sales-chart-card {
            padding: 18px;
        }

        .sales-chart-container {
            height: 260px;
        }

        .sales-chart-head {
            flex-wrap: wrap;
        }
    }
</style>

<!-- Page Heading -->
<div class="heading">
    <div>
        <h1>Dashboard Overview</h1>

        <p class="muted">
            Monitor your ElectroHub store,
            completed demo sales, and customer orders.
        </p>
    </div>

    <a href="{{ route('home') }}"
       class="btn btn-light">
        View Store →
    </a>
</div>

<!-- Existing Store Statistics -->
<div class="stats">

    <div class="stat">
        <div class="stat-icon">◈</div>

        <div class="stat-value">
            {{ $productsCount }}
        </div>

        <div class="stat-label">
             Products
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">▤</div>

        <div class="stat-value">
            {{ $categoriesCount }}
        </div>

        <div class="stat-label">
            Categories
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">▤</div>

        <div class="stat-value">
            {{ $brandsCount }}
        </div>

        <div class="stat-label">
            Brands
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">▣</div>

        <div class="stat-value">
            {{ $ordersCount }}
        </div>

        <div class="stat-label">
             Orders
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">▣</div>

        <div class="stat-value">
            {{ $usersCount }}
        </div>

        <div class="stat-label">
            Users
        </div>
    </div>

</div>

<!-- Sales Section Heading -->
<div class="heading">
    <div>
        <h1 style="font-size:24px">
            Sales Analytics
        </h1>

        <p class="muted">
            Completed demo order values,
            grouped by day, month, and year.
        </p>
    </div>
</div>

<!-- Sales KPI Cards -->
<div class="sales-kpis">

    <!-- Today -->
    <div class="sales-kpi">
        <div class="sales-kpi-header">
            <span class="sales-kpi-label">
                Today's Sales
            </span>

            <span class="sales-kpi-icon">◷</span>
        </div>

        <div class="sales-kpi-amount">
            ${{ number_format($todaySales, 2) }}
        </div>

        <div class="sales-kpi-note">
            Completed today
        </div>
    </div>

    <!-- Month -->
    <div class="sales-kpi">
        <div class="sales-kpi-header">
            <span class="sales-kpi-label">
                This Month's Sales
            </span>

            <span class="sales-kpi-icon">▥</span>
        </div>

        <div class="sales-kpi-amount">
            ${{ number_format($monthSales, 2) }}
        </div>

        <div class="sales-kpi-note">
            {{ now()->format('F Y') }}
        </div>
    </div>

    <!-- Year -->
    <div class="sales-kpi">
        <div class="sales-kpi-header">
            <span class="sales-kpi-label">
                This Year's Sales
            </span>

            <span class="sales-kpi-icon">▤</span>
        </div>

        <div class="sales-kpi-amount">
            ${{ number_format($yearSales, 2) }}
        </div>

        <div class="sales-kpi-note">
            {{ now()->format('Y') }}
        </div>
    </div>

</div>

<!-- Charts -->
<div class="sales-chart-grid">

    <!-- Daily Chart -->
    <section class="sales-chart-card wide">

        <div class="sales-chart-head">
            <div>
                <h2>Daily Sales</h2>
                <p>
                    Completed demo sales over
                    the last 14 days
                </p>
            </div>

            <span class="sales-chart-tag">
                Last 14 Days
            </span>
        </div>

        <div class="sales-chart-container">
            <canvas
                id="daily-sales-chart"
                role="img"
                aria-label="Daily sales line chart for the last 14 days"
            ></canvas>
        </div>

    </section>

    <!-- Monthly Chart -->
    <section class="sales-chart-card">

        <div class="sales-chart-head">
            <div>
                <h2>Monthly Sales</h2>
                <p>
                    Completed demo sales
                    by month
                </p>
            </div>

            <span class="sales-chart-tag">
                Last 12 Months
            </span>
        </div>

        <div class="sales-chart-container">
            <canvas
                id="monthly-sales-chart"
                role="img"
                aria-label="Monthly sales bar chart for the last 12 months"
            ></canvas>
        </div>

    </section>

    <!-- Yearly Chart -->
    <section class="sales-chart-card">

        <div class="sales-chart-head">
            <div>
                <h2>Yearly Sales</h2>
                <p>
                    Completed demo sales
                    by year
                </p>
            </div>

            <span class="sales-chart-tag">
                Last 5 Years
            </span>
        </div>

        <div class="sales-chart-container">
            <canvas
                id="yearly-sales-chart"
                role="img"
                aria-label="Yearly sales bar chart for the last 5 years"
            ></canvas>
        </div>

    </section>

</div>

<p class="sales-disclaimer">
    Note: ElectroHub is a portfolio demo.
    Charts show completed demo order values,
    not real payments or revenue.
    Dates are based on the last order update,
    which is when an order is marked completed
    in the current workflow.
</p>

<!-- Recent Orders -->
<section class="card">

    <div class="heading">
        <div>
            <h2>Recent Orders</h2>

            <p class="muted">
                Latest orders received by your store.
            </p>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-light">
            View All
        </a>
    </div>

    <div class="table-wrap">

        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <strong>
                                {{ $order->order_number }}
                            </strong>
                        </td>

                        <td>
                            {{ $order->customer_name }}
                        </td>

                        <td>
                            {{ $order->created_at->format('M d, Y') }}
                        </td>

                        <td>
                            ${{ number_format(
                                (float) $order->total_amount,
                                2
                            ) }}
                        </td>

                        <td>
                            <span class="status {{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            <a class="btn btn-light"
                               href="{{ route('admin.orders.show', $order) }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="muted">
                            No orders yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</section>

<!-- Original Demo Order Value -->
<section class="card">

    <h2>All Non-Cancelled Demo Orders</h2>

    <div style="
        font-size:30px;
        font-weight:850;
        color:#2477ee;
        margin:15px 0 7px
    ">
        ${{ number_format((float) $demoTotal, 2) }}
    </div>

    <p class="muted">
        Total value of pending, processing, and
        completed orders combined.
        This is not real sales revenue.
    </p>

</section>

<!-- Send data safely from Laravel to JavaScript -->
<script
    type="application/json"
    id="eh-sales-chart-data"
>@json($salesCharts)</script>

@vite('resources/js/admin-dashboard-charts.js')

@endsection
