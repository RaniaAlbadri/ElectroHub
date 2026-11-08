<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Headphones Pro',
                'category' => 'audio-devices',
                'brand' => 'SoundWave',
                'price' => 79.00,
                'stock' => 20,
            ],
            [
                'name' => 'Bluetooth Earbuds',
                'category' => 'audio-devices',
                'brand' => 'SoundWave',
                'price' => 45.00,
                'stock' => 35,
            ],
            [
                'name' => 'Mechanical Gaming Keyboard',
                'category' => 'computer-accessories',
                'brand' => 'TechGear',
                'price' => 89.00,
                'stock' => 15,
            ],
            [
                'name' => 'Wireless Gaming Mouse',
                'category' => 'computer-accessories',
                'brand' => 'TechGear',
                'price' => 39.00,
                'stock' => 30,
            ],
            [
                'name' => 'Fast USB-C Charger',
                'category' => 'mobile-accessories',
                'brand' => 'Voltix',
                'price' => 25.00,
                'stock' => 40,
            ],
            [
                'name' => 'Power Bank 20000mAh',
                'category' => 'mobile-accessories',
                'brand' => 'Voltix',
                'price' => 49.00,
                'stock' => 25,
            ],
            [
                'name' => 'Smart Watch Series X',
                'category' => 'smart-gadgets',
                'brand' => 'NovaTech',
                'price' => 119.00,
                'stock' => 12,
            ],
            [
                'name' => 'Smart LED Light',
                'category' => 'smart-gadgets',
                'brand' => 'NovaTech',
                'price' => 35.00,
                'stock' => 20,
            ],
            [
                'name' => 'Adjustable Laptop Stand',
                'category' => 'office-electronics',
                'brand' => 'DeskPro',
                'price' => 42.00,
                'stock' => 18,
            ],
            [
                'name' => 'LED Desk Lamp',
                'category' => 'office-electronics',
                'brand' => 'DeskPro',
                'price' => 55.00,
                'stock' => 22,
            ],
        ];

        foreach ($products as $item) {

            $category = Category::where(
                'slug',
                $item['category']
            )->firstOrFail();

            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'brand' => $item['brand'],
                    'description' => 'Premium tech accessory for everyday use.',
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'is_featured' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
