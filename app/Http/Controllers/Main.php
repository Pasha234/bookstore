<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class Main extends Controller
{
    public function show(Request $request) {
        return view('main.home');
    }

    public function catalog() {
        return view('main.catalog', [
            'categories' => Category::all()
        ]);
    }

    public function offer() {
        return view('main.offer');
    }

    public function compilation($id) {
        return view('main.compilation');
    }

    public function product($id) {
        return view('main.product', [
            'product' => Product::findOrFail($id),
            'feedbacks' => Feedback::where('item')
        ]);
    }

    public function search($id) {
        return view('main.search');
    }
}
