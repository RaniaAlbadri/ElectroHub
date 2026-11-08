<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\Wishlist;
use Throwable;

class AdminController extends Controller
{
    // Dashboard

    public function index()
    {
        $now = now();

        // Store statistics
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $brandsCount = Brand::count();
        $usersCount = User::count();

        $demoTotal = Order::where(
            'status', '!=', 'cancelled'
        )->sum('total_amount');

        $recentOrders = Order::latest()
            ->limit(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Chart periods
        |--------------------------------------------------------------------------
        */

        $daily = [];
        $monthly = [];
        $yearly = [];

        // Last 14 days, including today
        for ($i = 13; $i >= 0; $i--) {
            $key = $now->copy()
                ->subDays($i)
                ->format('Y-m-d');

            $daily[$key] = 0;
        }

        // Last 12 months, including current month
        for ($i = 11; $i >= 0; $i--) {
            $key = $now->copy()
                ->subMonthsNoOverflow($i)
                ->format('Y-m');

            $monthly[$key] = 0;
        }

        // Last 5 years, including current year
        for ($i = 4; $i >= 0; $i--) {
            $key = $now->copy()
                ->subYears($i)
                ->format('Y');

            $yearly[$key] = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Completed demo orders
        |--------------------------------------------------------------------------
        */

        $startDate = $now->copy()
            ->subYears(4)
            ->startOfYear();

        $completedOrders = Order::query()
            ->where('status', 'completed')
            ->where('updated_at', '>=', $startDate)
            ->where('updated_at', '<=', $now)
            ->get(['total_amount', 'updated_at']);

        foreach ($completedOrders as $order) {
            if (!$order->updated_at) {
                continue;
            }

            $date = $order->updated_at;

            // Use cents to reduce floating-point errors
            $amountCents = (int) round(
                (float) $order->total_amount * 100
            );

            $dayKey = $date->format('Y-m-d');
            $monthKey = $date->format('Y-m');
            $yearKey = $date->format('Y');

            if (array_key_exists($dayKey, $daily)) {
                $daily[$dayKey] += $amountCents;
            }

            if (array_key_exists($monthKey, $monthly)) {
                $monthly[$monthKey] += $amountCents;
            }

            if (array_key_exists($yearKey, $yearly)) {
                $yearly[$yearKey] += $amountCents;
            }
        }


        $todaySales = (
            $daily[$now->format('Y-m-d')] ?? 0
        ) / 100;

        $monthSales = (
            $monthly[$now->format('Y-m')] ?? 0
        ) / 100;

        $yearSales = (
            $yearly[$now->format('Y')] ?? 0
        ) / 100;

        $salesCharts = [
            'daily' => [
                'labels' => array_map(
                    fn ($date) => \Carbon\Carbon::parse($date)
                        ->format('d M'),
                    array_keys($daily)
                ),

                'values' => array_map(
                    fn ($cents) => round($cents / 100, 2),
                    array_values($daily)
                ),
            ],

            'monthly' => [
                'labels' => array_map(
                    fn ($date) => \Carbon\Carbon::parse(
                        $date . '-01'
                    )->format('M Y'),
                    array_keys($monthly)
                ),

                'values' => array_map(
                    fn ($cents) => round($cents / 100, 2),
                    array_values($monthly)
                ),
            ],

            'yearly' => [
                'labels' => array_keys($yearly),

                'values' => array_map(
                    fn ($cents) => round($cents / 100, 2),
                    array_values($yearly)
                ),
            ],
        ];

        return view('admin.dashboard', compact(
            'categoriesCount',
            'productsCount',
            'ordersCount',
            'brandsCount',
            'usersCount',
            'demoTotal',
            'recentOrders',
            'todaySales',
            'monthSales',
            'yearSales',
            'salesCharts'
        ));
    }


    private function uniqueSlug(
        string $name,
        string $table,
        ?int $exceptId = null
    ): string {
        $base = Str::slug($name) ?: 'item';
        $slug = $base;
        $number = 2;

        while (
            DB::table($table)
                ->where('slug', $slug)
                ->when($exceptId, function ($query) use ($exceptId) {
                    $query->where('id', '!=', $exceptId);
                })
                ->exists()
        ) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }



public function categories(Request $request)
{
    $editing = $request->filled('edit')
        ? Category::findOrFail($request->integer('edit'))
        : null;

    $query = Category::query()->withCount('products');

    // Search by category name or description
    $search = trim((string) $request->query('q', ''));

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Filter by category status
    $status = $request->query('status');

    if ($status === 'active') {
        $query->where('is_active', true);
    } elseif ($status === 'inactive') {
        $query->where('is_active', false);
    }

    return view('admin.categories', [
        'categories' => $query->latest()
            ->paginate(10)
            ->withQueryString(),

        'editing' => $editing,
    ]);
}



    private function categoryData(
        Request $request,
        ?Category $category = null
    ): array {
        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:120',
                Rule::unique('categories', 'name')
                    ->ignore($category?->id),
            ],
            'description' => [
                'nullable', 'string', 'max:1000'
            ],
            'image' => [
                'nullable', 'image', 'max:2048'
            ],
        ]);

        $data['slug'] = $this->uniqueSlug(
            $data['name'],
            'categories',
            $category?->id
        );

        $data['is_active'] = $request->boolean('is_active');

        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        return $data;
    }

    public function storeCategory(Request $request)
    {
        Category::create(
            $this->categoryData($request)
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function updateCategory(
        Request $request,
        Category $category
    ) {
        $oldImage = $category->image;
        $data = $this->categoryData($request, $category);

        $category->update($data);

        if (isset($data['image']) && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->withErrors([
                'admin' => 'This category contains products. Move or delete those products first.',
            ]);
        }

        $image = $category->image;
        $category->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return back()->with(
            'success', 'Category deleted successfully.'
        );
    }




public function products(Request $request)
{
    $editing = $request->filled('edit')
        ? Product::findOrFail($request->integer('edit'))
        : null;

    $query = Product::query()->with('category');

    // Search by product name, brand, or category
    $search = trim((string) $request->query('q', ''));

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('brand', 'like', "%{$search}%")
              ->orWhereHas('category', function ($category) use ($search) {
                  $category->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Filter by status
    $status = $request->query('status');

    if ($status === 'active') {
        $query->where('is_active', true);
    } elseif ($status === 'inactive') {
        $query->where('is_active', false);
    }

    // Filter by category
    if ($request->filled('category_id')) {
        $categoryId = $request->query('category_id');

        if (ctype_digit((string) $categoryId)) {
            $query->where('category_id', (int) $categoryId);
        }
    }

    // Filter by brand
    if ($request->filled('brand')) {
        $brand = trim((string) $request->query('brand'));

        $query->where('brand', $brand);
    }

    // Validate price filters
    $priceFilters = $request->validate([
        'min_price' => [
            'nullable', 'numeric', 'min:0', 'max:99999999'
        ],
        'max_price' => [
            'nullable', 'numeric', 'min:0', 'max:99999999'
        ],
    ]);

    // Products strictly above the entered price
    if ($request->filled('min_price')) {
        $query->where(
            'price',
            '>',
            $priceFilters['min_price']
        );
    }

    // Products strictly below the entered price
    if ($request->filled('max_price')) {
        $query->where(
            'price',
            '<',
            $priceFilters['max_price']
        );
    }

    return view('admin.products', [
        'products' => $query->latest()
            ->paginate(10)
            ->withQueryString(),

        'categories' => Category::orderBy('name')->get(),

        'brands' => \App\Models\Brand::orderBy('name')
            ->pluck('name'),

        'editing' => $editing,
    ]);
}




    private function productData(
        Request $request,
        ?Product $product = null
    ): array {
        $data = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'name' => [
                'required', 'string', 'max:150'
            ],
            'brand' => [
                'nullable', 'string', 'max:100'
            ],
            'description' => [
                'nullable', 'string', 'max:3000'
            ],
            'price' => [
                'required', 'numeric', 'min:0', 'max:99999999'
            ],
            'compare_at_price' => [
                'nullable', 'numeric', 'gt:price',
                'max:99999999'
            ],
            'stock' => [
                'required', 'integer', 'min:0', 'max:1000000'
            ],
            'image' => [
                'nullable', 'image', 'max:2048'
            ],
        ]);

        $data['slug'] = $this->uniqueSlug(
            $data['name'],
            'products',
            $product?->id
        );

        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        return $data;
    }

    public function storeProduct(Request $request)
    {
        Product::create(
            $this->productData($request)
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function updateProduct(
        Request $request,
        Product $product
    ) {
        $oldImage = $product->image;
        $data = $this->productData($request, $product);

        $product->update($data);

        if (isset($data['image']) && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroyProduct(Product $product)
    {
        $image = $product->image;

        $product->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return back()->with(
            'success', 'Product deleted successfully.'
        );
    }


public function orders(Request $request)
{
    $query = Order::query()->withCount('items');

    if ($request->filled('status')) {
        $query->where(
            'status',
            $request->query('status')
        );
    }

    $search = trim((string) $request->query('q', ''));

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('order_number', 'like', "%{$search}%")
              ->orWhere('customer_name', 'like', "%{$search}%")
              ->orWhere('customer_email', 'like', "%{$search}%");
        });
    }

    return view('admin.orders', [
        'orders' => $query->latest()
            ->paginate(12)
            ->withQueryString(),
    ]);
}


    public function showOrder(Order $order)
    {
        return view('admin.order-show', [
            'order' => $order->load('items'),
        ]);
    }

    public function updateOrder(
        Request $request,
        Order $order
    ) {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'processing',
                    'completed',
                    'cancelled',
                ]),
            ],
        ]);

        DB::transaction(function () use ($order, $data) {
            $locked = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array(
                $locked->status,
                ['pending', 'processing'],
                true
            )) {
                throw ValidationException::withMessages([
                    'admin' => 'Completed or cancelled orders cannot be changed.',
                ]);
            }

            // Return stock only once when cancelling.
            if ($data['status'] === 'cancelled') {
                $locked->load('items');

                foreach ($locked->items as $item) {
                    if ($item->product_id) {
                        Product::whereKey($item->product_id)
                            ->increment(
                                'stock',
                                $item->quantity
                            );
                    }
                }
            }

            $locked->update([
                'status' => $data['status'],
            ]);
        });

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    public function wishlists()
    {
        $totalSaves = Wishlist::count();

        $usersCount = Wishlist::query()
            ->distinct()
            ->count('user_id');

        $productsCount = Wishlist::query()
            ->distinct()
            ->count('product_id');

        $popularProducts = Wishlist::query()
            ->select('product_id')
            ->selectRaw('COUNT(*) as saves_count')
            ->with('product.category')
            ->groupBy('product_id')
            ->orderByDesc('saves_count')
            ->paginate(12);

        return view('admin.wishlists', compact(
            'totalSaves',
            'usersCount',
            'productsCount',
            'popularProducts'
        ));
    }


    // -----------------------------------------------------------------
    // Brands Management (keeps existing products.brand string column)
    // -----------------------------------------------------------------


public function brands(Request $request)
{
    $query = Brand::query()->withCount('products');

    $search = trim((string) $request->query('q', ''));

    if ($search !== '') {
        $query->where('name', 'like', "%{$search}%");
    }

    return view('admin.brands', [
        'brands' => $query->orderBy('name')->paginate(10),
    ]);
}


    public function storeBrand(Request $request)
    {
        $request->merge([
            'name' => trim((string) $request->input('name')),
        ]);

        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('brands', 'name'),
            ],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
        ]);

        $newLogo = null;

        if ($request->hasFile('logo')) {
            $newLogo = $request->file('logo')->store('brands', 'public');
        }

        try {
            Brand::create([
                'name' => $data['name'],
                'slug' => $this->uniqueSlug($data['name'], 'brands'),
                'logo' => $newLogo,
            ]);
        } catch (Throwable $e) {
            if ($newLogo) {
                Storage::disk('public')->delete($newLogo);
            }
            throw $e;
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function updateBrand(Request $request, Brand $brand)
    {
        $request->merge([
            'name' => trim((string) $request->input('name')),
        ]);

        $data = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('brands', 'name')->ignore($brand->id),
            ],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        $oldName = $brand->name;
        $oldLogo = $brand->logo;
        $newLogo = null;

        if ($request->hasFile('logo')) {
            $newLogo = $request->file('logo')->store('brands', 'public');
        }

        try {
            DB::transaction(function () use (
                $request, $data, $brand, $oldName, $oldLogo, $newLogo
            ) {
                $brand->update([
                    'name' => $data['name'],
                    'slug' => $this->uniqueSlug($data['name'], 'brands', $brand->id),
                    'logo' => $newLogo ?? (
                        $request->boolean('remove_logo') ? null : $oldLogo
                    ),
                ]);

                // A rename must also update the existing product records.
                if ($oldName !== $data['name']) {
                    Product::query()->where('brand', $oldName)
                        ->update(['brand' => $data['name']]);
                }
            });
        } catch (Throwable $e) {
            if ($newLogo) {
                Storage::disk('public')->delete($newLogo);
            }
            throw $e;
        }

        if ($oldLogo && $oldLogo !== $brand->logo) {
            Storage::disk('public')->delete($oldLogo);
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroyBrand(Brand $brand)
    {
        // Do not delete brands which still have assigned products.
        if ($brand->products()->exists()) {
            return back()->with('error',
                'This brand is used by products. Reassign those products before deleting it.'
            );
        }

        $logo = $brand->logo;
        $brand->delete();

        if ($logo) {
            Storage::disk('public')->delete($logo);
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }


private function selectedAdminIds(Request $request, string $table): array
{
    $data = $request->validate([
        'ids' => ['required', 'array', 'min:1', 'max:100'],
        'ids.*' => [
            'required',
            'integer',
            'distinct',
            Rule::exists($table, 'id'),
        ],
    ]);

    return array_map('intval', $data['ids']);
}

public function bulkDeleteCategories(Request $request)
{
    $ids = $this->selectedAdminIds($request, 'categories');
    $images = [];

    DB::transaction(function () use ($ids, &$images) {
        $categories = Category::whereIn('id', $ids)
            ->lockForUpdate()->get();

        foreach ($categories as $category) {
            if ($category->products()->exists()) {
                throw ValidationException::withMessages([
                    'bulk' => 'Cannot delete categories containing products.',
                ]);
            }
        }

        foreach ($categories as $category) {
            if ($category->image) {
                $images[] = $category->image;
            }
            $category->delete();
        }
    });

    if ($images) {
        Storage::disk('public')->delete($images);
    }

    return redirect()->route('admin.categories.index')
        ->with('success', 'Selected categories deleted.');
}

public function bulkDeleteProducts(Request $request)
{
    $ids = $this->selectedAdminIds($request, 'products');
    $images = [];

    DB::transaction(function () use ($ids, &$images) {
        $products = Product::whereIn('id', $ids)
            ->lockForUpdate()->get();

        foreach ($products as $product) {
            if ($product->image) {
                $images[] = $product->image;
            }

            $product->delete();
        }
    });

    if ($images) {
        Storage::disk('public')->delete($images);
    }

    return redirect()->route('admin.products.index')
        ->with('success', 'Selected products deleted.');
}

public function bulkDeleteBrands(Request $request)
{
    $ids = $this->selectedAdminIds($request, 'brands');
    $logos = [];

    DB::transaction(function () use ($ids, &$logos) {
        $brands = Brand::whereIn('id', $ids)
            ->lockForUpdate()->get();

        foreach ($brands as $brand) {
            if ($brand->products()->exists()) {
                throw ValidationException::withMessages([
                    'bulk' => 'Cannot delete brands linked to products.',
                ]);
            }
        }

        foreach ($brands as $brand) {
            if ($brand->logo) {
                $logos[] = $brand->logo;
            }

            $brand->delete();
        }
    });

    if ($logos) {
        Storage::disk('public')->delete($logos);
    }

    return redirect()->route('admin.brands.index')
        ->with('success', 'Selected brands deleted.');
}


public function bulkDeleteOrders(Request $request)
{
    $ids = $this->selectedAdminIds($request, 'orders');

    DB::transaction(function () use ($ids) {

        $orders = Order::whereIn('id', $ids)
            ->lockForUpdate()
            ->get();

        // Prevent deletion of pending or processing orders
        foreach ($orders as $order) {

            if (!in_array(
                $order->status,
                ['completed', 'cancelled'],
                true
            )) {

                throw ValidationException::withMessages([
                    'bulk' => 'Only completed or cancelled orders can be deleted. Pending and processing orders cannot be deleted.',
                ]);
            }
        }

        // Delete only eligible orders
        foreach ($orders as $order) {

            $order->items()->delete();

            $order->delete();
        }
    });

    return redirect()
        ->route('admin.orders.index')
        ->with(
            'success',
            'Selected orders deleted successfully.'
        );
}


    // ---------------------------------------------------------
    // Admin Management - Store Owner Only
    // ---------------------------------------------------------

    private function authorizeStoreOwner(Request $request): void
    {
        $ownerEmail = trim(
            (string) config('electrohub_admin.owner_email', '')
        );

        $currentUser = $request->user();

        abort_unless(
            $currentUser !== null
            && $currentUser->role === 'admin'
            && $ownerEmail !== ''
            && strcasecmp($currentUser->email, $ownerEmail) === 0,
            403,
            'Only the store owner can manage administrators.'
        );
    }

    public function admins(Request $request)
    {
        $this->authorizeStoreOwner($request);

        $search = trim(
            (string) $request->query('q', '')
        );

        $search = mb_substr($search, 0, 100);

        // Existing administrators
        $admins = User::query()
            ->where('role', 'admin')
            ->orderBy('name')
            ->get();

        // Accounts eligible for promotion
        $customersQuery = User::query()
            ->where('role', '!=', 'admin');

        if ($search !== '') {
            $customersQuery->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $customersQuery
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.admins', [
            'admins' => $admins,
            'customers' => $customers,
        ]);
    }

    
public function promoteAdmin(Request $request, User $user)
{
    $this->authorizeStoreOwner($request);

    if ($user->role === 'admin') {
        return redirect()
            ->route('admin.admins.index')
            ->with(
                'success',
                'This account is already an administrator.'
            );
    }

    $user->role = 'admin';
    $user->save();

    return redirect()
        ->route('admin.admins.index')
        ->with(
            'success',
            'Administrator access granted successfully.'
        );
}


public function revokeAdmin(Request $request, User $user)
{
    // Only the store owner can manage administrators
    $this->authorizeStoreOwner($request);

    $ownerEmail = trim(
        (string) config('electrohub_admin.owner_email', '')
    );

    // Never allow removing the store owner
    if (
        $user->id === $request->user()->id ||
        strcasecmp($user->email, $ownerEmail) === 0
    ) {
        return redirect()
            ->route('admin.admins.index')
            ->withErrors([
                'admin' => 'The store owner cannot be removed.',
            ]);
    }

    // Account must currently be an admin
    if ($user->role !== 'admin') {
        return redirect()
            ->route('admin.admins.index')
            ->withErrors([
                'admin' => 'This account is not an administrator.',
            ]);
    }

    // Keep at least one administrator
    if (User::where('role', 'admin')->count() <= 1) {
        return redirect()
            ->route('admin.admins.index')
            ->withErrors([
                'admin' => 'The last administrator cannot be removed.',
            ]);
    }

    // Revoke admin privileges, without deleting the account
    $user->role = 'customer';
    $user->save();

    // Record who removed the privileges
    \Illuminate\Support\Facades\Log::notice(
        'Administrator privileges revoked',
        [
            'performed_by' => $request->user()->id,
            'target_user' => $user->id,
            'target_email' => $user->email,
        ]
    );

    return redirect()
        ->route('admin.admins.index')
        ->with(
            'success',
            'Administrator access removed successfully.'
        );
}


public function activityLogs(Request $request)
{
    // Store owner only
    $this->authorizeStoreOwner($request);

    $search = mb_substr(
        trim((string) $request->query('q', '')),
        0,
        100
    );

    $section = (string) $request->query('section', '');

    $allowedSections = [
        'products',
        'categories',
        'brands',
        'orders',
        'admins',
        'users',
    ];

    if (!in_array($section, $allowedSections, true)) {
        $section = '';
    }

    $query = DB::table('admin_activity_logs');

    if ($search !== '') {
        $query->where(function ($q) use ($search) {
            $q->where('admin_name', 'like', "%{$search}%")
              ->orWhere('admin_email', 'like', "%{$search}%")
              ->orWhere('event', 'like', "%{$search}%")
              ->orWhere('target', 'like', "%{$search}%");
        });
    }

    if ($section !== '') {
        $query->where('section', $section);
    }

    $logs = $query
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    $totalLogs = DB::table('admin_activity_logs')->count();

    $todayLogs = DB::table('admin_activity_logs')
        ->whereDate('created_at', today())
        ->count();

    return view('admin.activity-logs', compact(
        'logs',
        'totalLogs',
        'todayLogs'
    ));
}


}
