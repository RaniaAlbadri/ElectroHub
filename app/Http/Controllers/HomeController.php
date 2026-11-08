<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('id')
            ->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('categories', 'products'));
    }
}
