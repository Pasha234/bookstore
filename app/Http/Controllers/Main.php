<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class Main extends Controller
{
    public function show(Request $request) {
        return view('main.home');
    }

    public function catalog() {
        return view('main.catalog');
    }

    public function offer() {
        return view('main.offer');
    }

    public function compilation($id) {
        return view('main.compilation');
    }

    public function product($id) {
        return view('main.product', [
            'product' => Product::findOrFail($id)
        ]);
    }

    public function search($id) {
        return view('main.search');
    }
}
