
@extends('admin.layout')

@section('title', 'Admin Activity Log')

@section('content')

<div class="heading">
    <div>
        <h1>Admin Activity Log</h1>
        <p class="muted">
            Track administrative actions across ElectroHub.
            Activity records are read-only.
        </p>
    </div>
</div>

{{-- Statistics --}}
<div class="stats"
     style="grid-template-columns:repeat(2,minmax(0,1fr));">

    <div class="stat">
        <div class="stat-icon">📋</div>
        <div class="stat-value">
            {{ number_format($totalLogs) }}
        </div>
        <div class="stat-label">
            Total Activities
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">🕒</div>
        <div class="stat-value">
            {{ number_format($todayLogs) }}
        </div>
        <div class="stat-label">
            Today's Activities
        </div>
    </div>

</div>

<section class="card">

    <h2>Activity History</h2>

    <p class="muted">
        Review actions performed by store administrators.
    </p>

    {{-- Search and Filters --}}
    <form
        method="GET"
        action="{{ route('admin.activity-logs.index') }}"
        class="actions"
        style="margin:20px 0;"
    >
        <input
            type="search"
            name="q"
            class="input"
            value="{{ request('q') }}"
            maxlength="100"
            placeholder="Search admin, email, action or item..."
            style="flex:1;min-width:210px;"
        >

        <select
            name="section"
            class="input"
            style="max-width:180px;"
        >
            <option value="">All Sections</option>

            @foreach([
                'products' => 'Products',
                'categories' => 'Categories',
                'brands' => 'Brands',
                'orders' => 'Orders',
                'admins' => 'Administrators',
                'users' => 'Users',
            ] as $value => $label)

                <option
                    value="{{ $value }}"
                    @selected(request('section') === $value)
                >
                    {{ $label }}
                </option>

            @endforeach
        </select>

        <button class="btn" type="submit">
            Search & Filter
        </button>

        <a
            href="{{ route('admin.activity-logs.index') }}"
            class="btn btn-light"
        >
            Clear
        </a>
    </form>

    {{-- Activity Table --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Administrator</th>
                    <th>Action</th>
                    <th>Section</th>
                    <th>Target</th>
                    <th>Date & Time</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)

                    <tr>
                        <td>
                            <strong>
                                {{ $log->admin_name }}
                            </strong>

                            <p class="muted">
                                {{ $log->admin_email }}
                            </p>
                        </td>

                        <td>
                            <strong>
                                {{ $log->event }}
                            </strong>

                            @if($log->selected_count !== null)
                                <p class="muted">
                                    {{ $log->selected_count }}
                                    selected
                                </p>
                            @endif

                            <p class="muted">
                                {{ $log->http_method }}
                            </p>
                        </td>

                        <td>
                            <span class="status">
                                {{ ucfirst($log->section) }}
                            </span>
                        </td>

                        <td>
                            @if($log->target)
                                {{ $log->target }}
                            @else
                                <span class="muted">
                                    —
                                </span>
                            @endif
                        </td>

                        <td style="white-space:nowrap;">
                            {{ \Illuminate\Support\Carbon::parse($log->created_at)->format('d M Y') }}

                            <p class="muted">
                                {{ \Illuminate\Support\Carbon::parse($log->created_at)->format('h:i A') }}
                            </p>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5">
                            <div style="text-align:center;padding:35px 15px;">

                                <strong>
                                    No activity records found.
                                </strong>

                                <p class="muted">
                                    Administrative changes will appear here.
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($logs->hasPages())
        <div class="pagination">
            {{ $logs->links() }}
        </div>
    @endif

</section>

@endsection
