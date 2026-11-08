<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Audio Devices',
            'Computer Accessories',
            'Mobile Accessories',
            'Smart Gadgets',
            'Office Electronics',
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                [
                    'name' => $name,
                    'is_active' => true,
                ]
            );
        }
    }
}
