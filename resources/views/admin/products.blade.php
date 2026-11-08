
@extends('admin.layout')

@section('title', 'Products')

@section('content')

<div class="heading">
    <div>
        <h1>Manage Products</h1>
        <p class="muted">
            Add, edit and manage the products in ElectroHub.
        </p>
    </div>
</div>

<section class="card">

    <h2>
        {{ $editing ? 'Edit Product' : 'Add New Product' }}
    </h2>

    <p class="muted">
        Product information is saved to the MySQL database.
    </p>


        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ $editing
                ? route('admin.products.update', $editing)
                : route('admin.products.store') }}"

            data-confirm="{{ $editing
                ? 'Save Product Changes?'
                : 'Add New Product?' }}"

            data-confirm-text="{{ $editing
                ? 'Do you want to save these product changes?'
                : 'Do you want to add this product to ElectroHub?' }}"

            data-confirm-button="{{ $editing
                ? 'Yes, Save Changes'
                : 'Yes, Add Product' }}"
        >


        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div class="form-grid">

            <div class="field">
                <label for="name">Product Name *</label>

                <input
                    class="input"
                    id="name"
                    name="name"
                    type="text"
                    maxlength="150"
                    value="{{ old('name', $editing?->name ?? '') }}"
                    required
                >
            </div>

            <div class="field">
                <label for="category_id">Category *</label>

                <select class="input"
                        name="category_id"
                        id="category_id"
                        required>

                    <option value="">Select Category</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(
                                old('category_id', $editing?->category_id)
                                == $category->id
                            )
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="brand">Brand</label>

                <input
                    class="input"
                    id="brand"
                    name="brand"
                    type="text"
                    maxlength="100"
                    value="{{ old('brand', $editing?->brand ?? '') }}"
                    placeholder="Example: Logitech"
                >
            </div>

            <div class="field">
                <label for="stock">Stock Quantity *</label>

                <input
                    class="input"
                    id="stock"
                    name="stock"
                    type="number"
                    min="0"
                    max="1000000"
                    value="{{ old('stock', $editing?->stock ?? 0) }}"
                    required
                >
            </div>

            <div class="field">
                <label for="price">Price ($) *</label>

                <input
                    class="input"
                    id="price"
                    name="price"
                    type="number"
                    min="0"
                    max="99999999"
                    step="0.01"
                    value="{{ old('price', $editing?->price ?? '') }}"
                    required
                >
            </div>

            <div class="field">
                <label for="compare_at_price">
                    Old Price ($)
                </label>

                <input
                    class="input"
                    id="compare_at_price"
                    name="compare_at_price"
                    type="number"
                    min="0"
                    step="0.01"
                    value="{{ old('compare_at_price', $editing?->compare_at_price ?? '') }}"
                    placeholder="Optional"
                >
            </div>

            <div class="field full">
                <label for="description">Description</label>

                <textarea
                    class="input"
                    id="description"
                    name="description"
                    maxlength="3000"
                >{{ old('description', $editing?->description ?? '') }}</textarea>
            </div>

            <div class="field">
                <label for="image">Product Image</label>

                <input
                    class="input"
                    id="image"
                    name="image"
                    type="file"
                    accept="image/*"
                >

                <p class="muted">Maximum image size: 2 MB</p>
            </div>

            <div class="field">
                @if($editing && $editing->image)
                    <label>Current Image</label>

                    <img
                        src="{{ asset('storage/' . $editing->image) }}"
                        alt="Current product image"
                        style="width:100px;height:100px;object-fit:cover;border-radius:10px"
                    >
                @endif
            </div>

            <div class="field full">

                <label class="check">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $editing?->is_active ?? true) ? 'checked' : '' }}
                    >
                    Active Product
                </label>

                <label class="check">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured', $editing?->is_featured ?? false) ? 'checked' : '' }}
                    >
                    Featured Product
                </label>

            </div>

        </div>

        <div class="actions">

            <button class="btn" type="submit">
                {{ $editing ? 'Save Product' : 'Add Product' }}
            </button>

            @if($editing)
                <a class="btn btn-light"
                   href="{{ route('admin.products.index') }}">
                    Cancel Editing
                </a>
            @endif

        </div>

    </form>

</section>

<section class="card">

    <div class="heading">
        <div>
            <h2>All Products</h2>
            <p class="muted">
                Manage your existing store inventory.
            </p>
        </div>
    </div>


@include('admin.partials.list-tools', ['section' => 'products'])

    <div class="table-wrap">
        <table>

            <thead>

                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)
                    <tr data-admin-row-id="{{ $product->id }}">
                        <td>
                            <div class="actions">

                                @if($product->image)
                                    <img
                                        class="thumb"
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt=""
                                    >
                                @endif

                                <strong>
                                    {{ $product->name }}
                                </strong>
                            </div>
                        </td>

                        <td>
                            {{ $product->category?->name ?? 'Uncategorized' }}
                        </td>

                        <td>
                            ${{ number_format(
                                (float)$product->price,
                                2
                            ) }}
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            <span class="status {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a class="btn btn-light"
                                   href="{{ route('admin.products.index', ['edit' => $product->id]) }}">
                                    Edit
                                </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        data-confirm="Delete this product?"
                                        data-confirm-text="Are you sure you want to delete this product?"
                                        data-confirm-icon="warning"
                                        data-confirm-button="Yes, Delete"
                                    >

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger"
                                            type="submit">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="muted">
                            No products found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>

</section>

@endsection
