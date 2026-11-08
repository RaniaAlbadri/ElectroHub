
@extends('admin.layout')

@section('title', 'Admin Management')

@section('content')

<div class="heading">
    <div>
        <h1>Admin Management</h1>
        <p class="muted">
            Manage administrator access for ElectroHub.
            Only the store owner can grant or remove admin privileges.
        </p>
    </div>
</div>

{{-- Statistics --}}
<div class="stats" style="grid-template-columns:repeat(2,minmax(0,1fr));">

    <div class="stat">
        <div class="stat-icon">🛡</div>

        <div class="stat-value">
            {{ $admins->count() }}
        </div>

        <div class="stat-label">
            Total Administrators
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">👤</div>

        <div class="stat-value">
            {{ $customers->total() }}
        </div>

        <div class="stat-label">
            Available Customer Accounts
        </div>
    </div>

</div>

{{-- Error Messages --}}
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- Current Administrators --}}
<section class="card">

    <h2>Current Administrators</h2>

    <p class="muted">
        Grant or revoke administrative privileges.
        The store owner account is protected.
    </p>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Access Control</th>
                </tr>
            </thead>

            <tbody>
                @forelse($admins as $admin)

                    @php
                        $isOwner =
                            config('electrohub_admin.owner_email') &&
                            strcasecmp(
                                $admin->email,
                                (string) config('electrohub_admin.owner_email')
                            ) === 0;
                    @endphp

                    <tr>
                        <td>
                            <strong>{{ $admin->name }}</strong>
                        </td>

                        <td>
                            {{ $admin->email }}
                        </td>

                        <td>
                            @if($isOwner)
                                <span class="status active">
                                    Store Owner
                                </span>
                            @else
                                <span class="status active">
                                    Administrator
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($isOwner)

                                <span class="muted">
                                    🔒 Protected Account
                                </span>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route('admin.admins.revoke', $admin) }}"
                                    data-confirm="Remove Administrator?"
                                    data-confirm-text="This person will lose access to the admin dashboard and become a regular customer. Their account will not be deleted."
                                    data-confirm-icon="warning"
                                    data-confirm-button="Yes, Remove Admin"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Remove Admin
                                    </button>
                                </form>

                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="muted">
                            No administrators found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>

{{-- Assign New Administrator --}}
<section class="card">

    <h2>Assign New Administrator</h2>

    <p class="muted">
        Search for an existing customer account
        and grant administrator access.
    </p>

    {{-- Search --}}
    <form
        method="GET"
        action="{{ route('admin.admins.index') }}"
        class="actions"
        style="margin:18px 0;"
    >
        <input
            class="input"
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search by name or email..."
            maxlength="100"
            style="flex:1;min-width:200px;"
        >

        <button
            class="btn"
            type="submit"
        >
            Search
        </button>

        <a
            href="{{ route('admin.admins.index') }}"
            class="btn btn-light"
        >
            Clear
        </a>
    </form>

    {{-- Customers Table --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Current Role</th>
                    <th>Grant Access</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)

                    <tr>
                        <td>
                            <strong>
                                {{ $customer->name }}
                            </strong>

                            <p class="muted">
                                {{ $customer->email }}
                            </p>
                        </td>

                        <td>
                            <span class="status">
                                Customer
                            </span>
                        </td>

                        <td>
                            <form
                                method="POST"
                                action="{{ route('admin.admins.promote', $customer) }}"
                                data-confirm="Grant Admin Access?"
                                data-confirm-text="Are you sure you want to give this customer administrator privileges?"
                                data-confirm-icon="warning"
                                data-confirm-button="Yes, Grant Access"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    class="btn"
                                    type="submit"
                                >
                                    Make Admin
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="3" class="muted">
                            No customer accounts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($customers->hasPages())
        <div class="pagination">
            {{ $customers->links() }}
        </div>
    @endif

</section>

@endsection
