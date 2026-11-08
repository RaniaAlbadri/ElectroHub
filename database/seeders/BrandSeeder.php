<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        // Default electronics brands
        $brands = collect([
            'Apple',
            'Samsung',
            'Logitech',
            'Sony',
            'JBL',
            'Anker',
            'UGREEN',
            'Baseus',
            'Razer',
            'Xiaomi',
        ]);

        // Include brands already used by products
        $productBrands = Product::query()
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->pluck('brand');

        $brands = $brands
            ->merge($productBrands)
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->unique(fn ($name) => mb_strtolower($name));

        foreach ($brands as $name) {
            Brand::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => Str::slug($name),
                    'logo' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}
