
@extends('admin.layout')

@section('title', 'Wishlist Analytics')

@section('content')

<div class="heading">
    <div>
        <h1>Wishlist Analytics</h1>

        <p class="muted">
            Discover which products customers love most.
        </p>
    </div>

    <a href="{{ route('home') }}"
       class="btn btn-light">
        View Store →
    </a>
</div>


<!-- Statistics -->
<div class="stats">

    <div class="stat">
        <div class="stat-icon">♡</div>

        <div class="stat-value">
            {{ $totalSaves }}
        </div>

        <div class="stat-label">
            Total Wishlist Saves
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">◉</div>

        <div class="stat-value">
            {{ $usersCount }}
        </div>

        <div class="stat-label">
            Users With Favorites
        </div>
    </div>

    <div class="stat">
        <div class="stat-icon">◈</div>

        <div class="stat-value">
            {{ $productsCount }}
        </div>

        <div class="stat-label">
            Products Favorited
        </div>
    </div>

</div>

<!-- Popular Products -->
<section class="card">

    <div class="heading">
        <div>
            <h2>Most Wishlisted Products</h2>

            <p class="muted">
                Products ranked by the number
                of users who saved them.
            </p>
        </div>
    </div>

    <div class="table-wrap">

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Wishlist Saves</th>
                </tr>
            </thead>

            <tbody>

                @forelse($popularProducts as $row)

                    @if($row->product)

                        <tr>

                            <td>
                                <div class="actions">

                                    @if($row->product->image)
                                        <img
                                            src="{{ asset('storage/' . $row->product->image) }}"
                                            class="thumb"
                                            alt=""
                                        >
                                    @endif

                                    <strong>
                                        {{ $row->product->name }}
                                    </strong>
                                </div>
                            </td>

                            <td>
                                {{ $row->product->category?->name ?? 'Other' }}
                            </td>

                            <td>
                                ${{ number_format(
                                    (float) $row->product->price,
                                    2
                                ) }}
                            </td>

                            <td>
                                <span class="status">
                                    ♡ {{ $row->saves_count }} Saves
                                </span>
                            </td>

                        </tr>

                    @endif

                @empty

                    <tr>
                        <td colspan="4" class="muted">
                            No products have been added
                            to wishlists yet.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    <div class="pagination">
        {{ $popularProducts->links() }}
    </div>

</section>

@endsection
