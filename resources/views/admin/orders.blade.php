
@extends('admin.layout')

@section('title', 'Orders')

@section('content')

<div class="heading">
    <div>
        <h1>Manage Orders</h1>
        <p class="muted">
            Review and manage customer demo orders.
        </p>
    </div>
</div>

<section class="card">

    <div class="heading">
        <h2>All Orders</h2>

        <form method="GET"
              action="{{ route('admin.orders.index') }}">

            <select class="input"
                    name="status"
                    onchange="this.form.submit()">

                <option value="">All Statuses</option>

                @foreach([
                    'pending',
                    'processing',
                    'completed',
                    'cancelled'
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(request('status') === $status)
                    >
                        {{ ucfirst($status) }}
                    </option>

                @endforeach
            </select>

        </form>
    </div>


@include('admin.partials.list-tools', ['section' => 'orders'])

<p class="muted" style="margin: 10px 0 18px;">
    Note: Only Completed and Cancelled orders
    can be selected for deletion.
    Pending and Processing orders are protected.
</p>

    <div class="table-wrap">

        <table>
            <thead>

            <tr>

                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($orders as $order)

                    <tr
                        @if(in_array($order->status, ['completed', 'cancelled'], true))
                            data-admin-row-id="{{ $order->id }}"
                        @endif
                    >
                        <td>
                            <strong>
                                {{ $order->order_number }}
                            </strong>
                        </td>

                        <td>
                            {{ $order->customer_name }}
                            <div class="muted">
                                {{ $order->customer_email }}
                            </div>
                        </td>

                        <td>
                            {{ $order->created_at->format('M d, Y') }}
                        </td>

                        <td>{{ $order->items_count }}</td>

                        <td>
                            <strong>
                                ${{ number_format(
                                    (float)$order->total_amount,
                                    2
                                ) }}
                            </strong>
                        </td>

                        <td>
                            <span class="status {{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td>
                            <a class="btn btn-light"
                               href="{{ route('admin.orders.show', $order) }}">
                                View Details
                            </a>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="7"
                            class="muted">
                            No orders found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    <div class="pagination">
        {{ $orders->links() }}
    </div>

</section>

@endsection
