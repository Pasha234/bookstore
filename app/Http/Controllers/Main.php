<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Offer;
use App\Models\Offer_items;
use App\Models\Category;
use App\Models\Direction;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    public function main(Request $request) {
        $offers = Offer::all();
        $slider_offers = [];
        for ($i = 1; $i < 6; $i++) {
            foreach($offers as $offer) {
                if($offer->slider_num == $i) {
                    $slider_offers[] = $offer;
                    break;
                }
            }
        }
        if (Auth::check()) {
            $user = Auth::user();
            return view('main.home', [
                'user' => $user,
                'offers' => $offers,
                'slider_offers' => $slider_offers
            ]);
        } else {
            return view('main.home', [
                'offers' => $offers,
                'slider_offers' => $slider_offers
            ]);
        }
    }

    public function catalog() {
        return view('main.catalog', [
            'categories' => Category::all()
        ]);
    }

    public function offer($id) {
        if (Auth::check()) {
            $user = Auth::user();
            $offer = Offer::findOrFail($id);
            return view('main.offer', [
                'user' => $user,
                'offer' => $offer
            ]);
        } else {
            $offer = Offer::findOrFail($id);
            return view('main.offer', [
                'offer' => $offer
            ]);
        }
    }

    public function compilation($id) {
        return view('main.compilation');
    }

    public function product($id) {
        $feedbacks = Feedback::where('product_id', $id)
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
        ->get();
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::where('products.id', $id)
                ->leftJoin('shoplist', function($join) {
                    $join->on('products.id', '=', 'shoplist.item_id')
                        ->where('shoplist.user_id', '=', Auth::id());
                })
                ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
                ->first();
                
            return view('main.product', [
                'product' => $product,
                'feedbacks' => $feedbacks,
                'user' => $user
            ]);
        } else {
            $product = Product::findOrFail($id);
            return view('main.product', [
                'product' => $product,
                'feedbacks' => $feedbacks
            ]);
        }
    }

    public function search($category) {
        $directions = Direction::join('categories', 'categories.id', 'directions.category')
            ->where('categories.link', '=', $category)
            ->select('directions.*')
            ->get();

        if (Auth::check()) {
            $user = Auth::user();
            return view('main.search', [
                'directions' => $directions,
                'user' => $user
            ]);
        } else {
            return view('main.search', [
                'directions' => $directions
            ]);
        }
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

    public function getOfferItems($id) {
        if (Auth::check()) {
            $items = Offer_items::where('offer_items.offer_id', $id)
            ->leftJoin('products', 'offer_items.item_id', 'products.id')
            ->leftJoin('shoplist', function($join) {
                $join->on('products.id', '=', 'shoplist.item_id')
                    ->where('shoplist.user_id', '=', Auth::id());
            })
            ->select('products.*', 'shoplist.quantity', 'shoplist.id as shoplist_id')
            ->get();
            return json_encode($items);   
        } else {
            $items = Offer_items::where('offer_items.offer_id', $id)
            ->leftJoin('products', 'offer_items.item_id', 'products.id')
            ->select('products.*')
            ->get();
            return json_encode($items);
        }
    }

    public function getSearchedItems($category) {
        $category = Category::where('link', $category)
            ->first();
        if (!is_null($category)) {
            $whereConds = [];
            $whereConds[] = ['products.category', '=', $category->id];
            if (isset($_GET['min_price'])) {
                $whereConds[] = ['products.price', '>', $_GET['min_price']];
            }
            if (isset($_GET['max_price'])) {
                $whereConds[] = ['products.price', '<', $_GET['max_price']];
            }
            if (isset($_GET['search_word'])) {
                $whereConds[] = ['products.name', 'like', '%' . $_GET['search_word'] . '%'];
            }
            if (Auth::check()) {
                if (isset($_GET['directions'])) {
                    $items = Product::where($whereConds)
                        ->leftJoin('shoplist', function($join) {
                            $join->on('products.id', '=', 'shoplist.item_id')
                                ->where('shoplist.user_id', '=', Auth::id());
                        })
                        ->whereIn('products.direction', explode(',', $_GET['directions']))
                        ->select('products.*', 
                            'shoplist.id as shoplist_id', 
                            'shoplist.quantity'
                            )
                        ->get();
                } else {
                    $items = Product::where($whereConds)
                        ->leftJoin('shoplist', function($join) {
                            $join->on('products.id', '=', 'shoplist.item_id')
                                ->where('shoplist.user_id', '=', Auth::id());
                        })
                        ->select('products.*', 
                            'shoplist.id as shoplist_id', 
                            'shoplist.quantity'
                            )
                        ->get();
                }
                
            } else {
                $whereConds = [];
                $whereConds[] = ['category', '=', $category->id];
                if (isset($_GET['min_price'])) {
                    $whereConds[] = ['price', '>', $_GET['min_price']];
                }
                if (isset($_GET['max_price'])) {
                    $whereConds[] = ['price', '<', $_GET['max_price']];
                }
                if (isset($_GET['search_word'])) {
                    $whereConds[] = ['products.name', 'like', '%' . $_GET['search_word'] . '%'];
                }
                if (isset($_GET['directions'])) {
                    $items = Product::where($whereConds)
                        ->whereIn('direction', explode(',', $_GET['directions']))
                        ->get();
                } else {
                    $items = Product::where($whereConds)
                        ->get();
                }
            }
            return response()->json($items);
        } else {
            return response()->json(['msg' => 'No such category']);
        }
    }
}
