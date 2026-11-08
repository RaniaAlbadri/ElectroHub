
@extends('admin.layout')

@section('title', 'Brands')

@section('content')

@php
    $editing = request()->filled('edit')
        ? $brands->firstWhere('id', (int) request('edit'))
        : null;
@endphp

<div class="heading">
    <div>
        <h1>Manage Brands</h1>
        <p class="muted">
            Organize the brands available in your store.
        </p>
    </div>
</div>

@if(session('error'))
    <section class="card">
        <p style="color: #c03953;">
            {{ session('error') }}
        </p>
    </section>
@endif

@if($errors->any())
    <section class="card">
        <ul style="color: #c03953; margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </section>
@endif

<section class="card">

    <h2>
        {{ $editing ? 'Edit Brand' : 'Add New Brand' }}
    </h2>

    <p class="muted">
        Brand names and logos appear in your storefront.
    </p>

    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ $editing
            ? route('admin.brands.update', $editing)
            : route('admin.brands.store') }}"

        data-confirm="{{ $editing
            ? 'Save Brand Changes?'
            : 'Add New Brand?' }}"

        data-confirm-text="{{ $editing
            ? 'Do you want to save these changes?'
            : 'Do you want to add this brand?' }}"

        data-confirm-button="{{ $editing
            ? 'Yes, Save Changes'
            : 'Yes, Add Brand' }}"
    >

        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div class="form-grid">

            <div class="field">
                <label for="name">Brand Name *</label>

                <input
                    class="input"
                    id="name"
                    name="name"
                    type="text"
                    maxlength="100"
                    value="{{ old('name', $editing?->name ?? '') }}"
                    required
                >
            </div>

            <div class="field">
                <label for="logo">Brand Logo</label>

                <input
                    class="input"
                    id="logo"
                    name="logo"
                    type="file"
                    accept="image/png,image/jpeg,image/webp"
                >

                <p class="muted">
                    Maximum image size: 2 MB
                </p>
            </div>

            @if($editing && $editing->logo)

                <div class="field full">

                    <label>Current Logo</label>

                    <img
                        class="thumb"
                        src="{{ asset('storage/' . $editing->logo) }}"
                        alt="{{ $editing->name }} logo"
                    >

                    <label class="check">
                        <input
                            type="checkbox"
                            name="remove_logo"
                            value="1"
                            {{ old('remove_logo') ? 'checked' : '' }}
                        >
                        Remove Current Logo
                    </label>

                </div>

            @endif

        </div>

        <div class="actions">

            <button type="submit" class="btn">
                {{ $editing ? 'Save Changes' : 'Add Brand' }}
            </button>

            @if($editing)
                <a
                    href="{{ route('admin.brands.index') }}"
                    class="btn btn-light"
                >
                    Cancel Editing
                </a>
            @endif

        </div>

    </form>

</section>

<section class="card">

    <h2>All Brands</h2>

    <p class="muted">
        Manage the brands currently stored in MySQL.
    </p>

    	@include('admin.partials.list-tools', ['section' => 'brands'])
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Products</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($brands as $brand)

                    <tr  data-admin-row-id="{{ $brand->id }}">
                        <td>
                            <div class="actions">

                                @if($brand->logo)
                                    <img
                                        class="thumb"
                                        src="{{ asset('storage/' . $brand->logo) }}"
                                        alt="{{ $brand->name }} logo"
                                    >
                                @endif

                                <strong>
                                    {{ $brand->name }}
                                </strong>

                            </div>
                        </td>

                        <td>
                            {{ $brand->products_count }}
                        </td>

                        <td>
                            <span class="status {{ $brand->logo ? 'active' : 'inactive' }}">
                                {{ $brand->logo ? 'Uploaded' : 'No Logo' }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a
                                    class="btn btn-light"
                                    href="{{ route('admin.brands.index', ['edit' => $brand->id]) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.brands.destroy', $brand) }}"

                                    data-confirm="Delete this brand?"

                                    data-confirm-text="Are you sure you want to delete this brand?"

                                    data-confirm-icon="warning"

                                    data-confirm-button="Yes, Delete"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger"
                                        type="submit"
                                        @disabled($brand->products_count > 0)
                                        title="{{ $brand->products_count > 0
                                            ? 'Move products to another brand before deleting'
                                            : 'Delete brand' }}"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="muted">
                            No brands found.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>
    </div>

    <p class="muted">
        Total brands: {{ $brands->count() }}.
        Brands with linked products cannot be deleted.
    </p>

    {{ $brands->links() }}
</section>

@endsection
