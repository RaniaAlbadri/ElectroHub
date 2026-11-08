
@extends('admin.layout')

@section('title', 'Categories')

@section('content')

<div class="heading">
    <div>
        <h1>Manage Categories</h1>
        <p class="muted">
            Organize your store into product categories.
        </p>
    </div>
</div>

<section class="card">

    <h2>
        {{ $editing ? 'Edit Category' : 'Add New Category' }}
    </h2>

    <p class="muted">
        Category names and images appear in your storefront.
    </p>


        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ $editing
                ? route('admin.categories.update', $editing)
                : route('admin.categories.store') }}"

            data-confirm="{{ $editing
                ? 'Save Category Changes?'
                : 'Add New Category?' }}"

            data-confirm-text="{{ $editing
                ? 'Do you want to save these changes?'
                : 'Do you want to add this category?' }}"

            data-confirm-button="{{ $editing
                ? 'Yes, Save Changes'
                : 'Yes, Add Category' }}"
        >


        @csrf

        @if($editing)
            @method('PUT')
        @endif

        <div class="form-grid">

            <div class="field">
                <label for="name">Category Name *</label>

                <input
                    class="input"
                    id="name"
                    name="name"
                    type="text"
                    maxlength="120"
                    value="{{ old('name', $editing?->name ?? '') }}"
                    required
                >
            </div>

            <div class="field">
                <label for="image">Category Image</label>

                <input
                    class="input"
                    id="image"
                    name="image"
                    type="file"
                    accept="image/*"
                >

                <p class="muted">Maximum image size: 2 MB</p>
            </div>

            <div class="field full">
                <label for="description">Description</label>

                <textarea
                    class="input"
                    id="description"
                    name="description"
                    maxlength="1000"
                >{{ old('description', $editing?->description ?? '') }}</textarea>
            </div>

            <div class="field full">

                <label class="check">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $editing?->is_active ?? true) ? 'checked' : '' }}
                    >
                    Active Category
                </label>

            </div>
        </div>

        <div class="actions">

            <button type="submit" class="btn">
                {{ $editing ? 'Save Changes' : 'Add Category' }}
            </button>

            @if($editing)
                <a href="{{ route('admin.categories.index') }}"
                   class="btn btn-light">
                    Cancel Editing
                </a>
            @endif

        </div>

    </form>
</section>

<section class="card">

    <h2>All Categories</h2>

    <p class="muted">
        Manage the categories currently stored in MySQL.
    </p>

    	@include('admin.partials.list-tools', ['section' => 'categories'])
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                    <tr  data-admin-row-id="{{ $category->id }}">
                        <td>
                            <div class="actions">
                                @if($category->image)
                                    <img
                                        class="thumb"
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt=""
                                    >
                                @endif

                                <strong>{{ $category->name }}</strong>
                            </div>
                        </td>

                        <td>{{ $category->products_count }}</td>

                        <td>
                            <span class="status {{ $category->is_active ? 'active' : 'inactive' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <div class="actions">

                                <a class="btn btn-light"
                                   href="{{ route('admin.categories.index', ['edit' => $category->id]) }}">
                                    Edit
                                </a>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        data-confirm="Delete this category?"
                                        data-confirm-text="Are you sure you want to delete this category?"
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
                        <td colspan="4" class="muted">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $categories->links() }}
    </div>

</section>

@endsection
