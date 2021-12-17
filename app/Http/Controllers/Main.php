<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    public function main(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            return view('main.home', [
                'user' => $user,
            ]);
        } else {
            
            return view('main.home', [
                'discount_items' => $discount_items,
            ]);
        }
        
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
        if (Auth::check()) {
            $product = Product::where('products.id', $id)
                ->leftJoin('shoplist', function($join) {
                    $join->on('products.id', '=', 'shoplist.item_id')
                        ->where('shoplist.user_id', '=', Auth::id());
                })
                ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
                ->first();
        } else {
            $product = Product::findOrFail($id);
        }
        return view('main.product', [
            'product' => $product,
            'feedbacks' => Feedback::where('product_id', $id)
                ->limit(5)
                ->join('users', 'users.id', '=', 'feedbacks.user_id')
                ->select(
                    'feedbacks.id as id',
                    'feedbacks.created_at as created_at',
                    'feedbacks.grade as grade',
                    'feedbacks.text as text',
                    'users.name as user_name',
                    )
                ->orderBy('feedbacks.created_at')
                ->get()
        ]);
    }

    public function search() {
        return view('main.search');
    }

    public function searchItems() {
        if (Auth::check()) {
            $search_items = Product::where('previous_price', '>', '0')
                ->leftJoin('shoplist', function($join) {
                    $join->on('products.id', '=', 'shoplist.item_id')
                        ->where('shoplist.user_id', '=', Auth::id());
                })
                ->orderBy(DB::raw('previous_price-price'), 'desc')
                ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
                ->get();
            return json_encode($search_items);
        } else {
            $search_items = Product::where('previous_price', '>', '0')
                ->orderBy(DB::raw('previous_price-price'), 'desc')
                ->get();
            return json_encode($search_items);
        }
    }

    public function getDiscountProducts() {
        if (Auth::check()) {
            $discount_items = Product::where('previous_price', '>', '0')
                ->leftJoin('shoplist', function($join) {
                    $join->on('products.id', '=', 'shoplist.item_id')
                        ->where('shoplist.user_id', '=', Auth::id());
                })
                ->orderBy(DB::raw('previous_price-price'), 'desc')
                ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
                ->get();
        } else {
            $discount_items = Product::where('previous_price', '>', '0')
                ->orderBy(DB::raw('previous_price-price'), 'desc')
                ->get();
        }
        return json_encode($discount_items);
    }

    public function getSimiliarItems($id) {
        if (Auth::check()) {
            $item = Product::find($id);
            if (!is_null($item)) {
                $similiar_items = Product::where('products.category', '=', $item->category)
                    ->leftJoin('shoplist', function($join) {
                        $join->on('products.id', '=', 'shoplist.item_id')
                            ->where('shoplist.user_id', '=', Auth::id());
                    })
                    ->whereNotIn('products.id', [$id])
                    ->limit(3)
                    ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
                    ->get();
                return json_encode($similiar_items);
            }
        } else {
            $item = Product::find($id);
            if (!is_null($item)) {
                $similiar_items = Product::where('category', '=', $item->category)
                    ->whereNotIn('id', [$id])
                    ->limit(3)
                    ->get();
                return json_encode($similiar_items);
            }    
        }
        return null;
    }
}
