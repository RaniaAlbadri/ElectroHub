
@if($errors->has('bulk'))
    <p style="color:#c03953">
        {{ $errors->first('bulk') }}
    </p>
@endif

<div class="admin-tools" data-admin-tools>

    <form
        method="GET"
        action="{{ route('admin.' . $section . '.index') }}"
        class="admin-search"
    >

        <input
            class="input"
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search {{ ucfirst($section) }}..."
            maxlength="100"
        >


@if($section === 'categories')

    <select class="input" name="status">

        <option value="">
            All Categories
        </option>

        <option value="active"
            @selected(request('status') === 'active')>
            Active
        </option>

        <option value="inactive"
            @selected(request('status') === 'inactive')>
            Inactive
        </option>

    </select>

@endif


@if($section === 'products')

    {{-- Category Filter --}}
    <select class="input" name="category_id">

        <option value="">All Categories</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(request('category_id') == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    {{-- Brand Filter --}}
    <select class="input" name="brand">

        <option value="">All Brands</option>

        @foreach($brands as $brand)
            <option
                value="{{ $brand }}"
                @selected(request('brand') === $brand)
            >
                {{ $brand }}
            </option>
        @endforeach

    </select>

    {{-- Status Filter --}}
    <select class="input" name="status">

        <option value="">All Products</option>

        <option
            value="active"
            @selected(request('status') === 'active')
        >
            Active
        </option>

        <option
            value="inactive"
            @selected(request('status') === 'inactive')
        >
            Inactive
        </option>

    </select>

    {{-- Minimum Price --}}
    <input
        class="input"
        type="number"
        name="min_price"
        min="0"
        step="0.01"
        placeholder="Price greater than..."
        value="{{ request('min_price') }}"
    >

    {{-- Maximum Price --}}
    <input
        class="input"
        type="number"
        name="max_price"
        min="0"
        step="0.01"
        placeholder="Price less than..."
        value="{{ request('max_price') }}"
    >

@endif

        @if($section === 'orders')
            <select class="input" name="status">
                <option value="">All Statuses</option>

                @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}"
                        @selected(request('status') === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        @endif

        <button class="btn" type="submit">
            Search
        </button>

        <a
            class="btn btn-light"
            href="{{ route('admin.' . $section . '.index') }}"
        >
            Clear
        </a>

    </form>

    <form
        method="POST"
        action="{{ route('admin.' . $section . '.bulk-delete') }}"
        data-bulk-form
    >
        @csrf
        @method('DELETE')

        <span class="muted" data-selected-count>
            0 selected
        </span>

        <button
            type="submit"
            class="btn btn-danger"
            data-bulk-button
            disabled
        >
            Delete Selected
        </button>
    </form>

</div>

@once
<style>
    .admin-tools {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin: 18px 0;
    }

    .admin-search {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .admin-search .input {
        width: auto;
        min-width: 180px;
    }

    .admin-tools [data-bulk-form] {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .admin-tools button:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .bulk-cell {
        width: 40px;
        text-align: center;
    }

    .bulk-cell input {
        width: 17px;
        height: 17px;
        accent-color: #2477ee;
    }

    @media(max-width:650px) {
        .admin-search,
        .admin-search .input {
            width: 100%;
        }
    }

.admin-tools .admin-search {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.admin-tools .admin-search .input {
    flex: 1 1 170px;
    min-width: 150px;
    max-width: 260px;
}

.admin-tools .admin-search button,
.admin-tools .admin-search .btn {
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .admin-tools .admin-search .input {
        max-width: 100%;
        flex-basis: 100%;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('[data-admin-tools]')
        .forEach(function (tools) {

            const section = tools.closest('section');
            const table = section?.querySelector('table');
            const form = tools.querySelector('[data-bulk-form]');
            const button = tools.querySelector('[data-bulk-button]');
            const counter = tools.querySelector('[data-selected-count]');

            if (!table || !form) return;

            const rows = [...table.querySelectorAll(
                'tbody tr[data-admin-row-id]'
            )];

            const checks = [];
            let selectAll = null;

            const header = table.querySelector('thead tr');

            if (header && rows.length) {
                const th = document.createElement('th');
                th.className = 'bulk-cell';

                selectAll = document.createElement('input');
                selectAll.type = 'checkbox';
                selectAll.setAttribute(
                    'aria-label',
                    'Select all on this page'
                );

                th.appendChild(selectAll);
                header.prepend(th);
            }

            rows.forEach(function (row) {

                const id = row.dataset.adminRowId;

                if (!/^\d+$/.test(id || '')) return;

                const td = document.createElement('td');
                td.className = 'bulk-cell';

                const check = document.createElement('input');
                check.type = 'checkbox';
                check.value = id;

                td.appendChild(check);
                row.prepend(td);
                checks.push(check);

                check.addEventListener('change', refresh);
            });

            function refresh() {
                const count = checks.filter(c => c.checked).length;

                counter.textContent = count + ' selected';
                button.disabled = count === 0;

                if (selectAll) {
                    selectAll.checked =
                        count === checks.length && count > 0;

                    selectAll.indeterminate =
                        count > 0 && count < checks.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checks.forEach(c => c.checked = selectAll.checked);
                    refresh();
                });
            }

            form.addEventListener('submit', async function (event) {

                event.preventDefault();

                const ids = checks
                    .filter(c => c.checked)
                    .map(c => c.value);

                if (!ids.length) return;

                const message =
                    'Permanently delete ' + ids.length +
                    ' selected records? This cannot be undone.';

                
                if (!window.Swal || typeof window.Swal.fire !== 'function') {
                    console.error('SweetAlert2 is not loaded.');
                    return;
                }

                const result = await window.Swal.fire({
                    title: 'Delete Selected?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#d43d58',
                    cancelButtonColor: '#64748b',
                    reverseButtons: true,
                    focusCancel: true
                });

                const confirmed = result.isConfirmed;

                if (!confirmed) return;


                form.querySelectorAll('[data-bulk-id]')
                    .forEach(el => el.remove());

                ids.forEach(function (id) {
                    const input = document.createElement('input');

                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    input.dataset.bulkId = '1';

                    form.appendChild(input);
                });

                HTMLFormElement.prototype.submit.call(form);
            });

            refresh();
        });
});
</script>
@endonce
