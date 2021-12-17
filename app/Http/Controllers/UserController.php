<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shoplist;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function personal() {
        if (Auth::check()){
            return view('user.personal',[
                'user' => Auth::user()
            ]);
        } else {
            return redirect('/login');
        }
    }

    public function login() {
        if (Auth::check()) {
            return redirect('/personal');
        } else {
            return view('user.login');
        }
    }

    public function register() {
        if (Auth::check()) {
            return redirect('/personal');
        } else {
            return view('user.register');
        }
    }

    public function order() {
        return view('user.order');
    }

    public function shoplist() {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user.shoplist', [
                'user' => $user,
                'items' => Shoplist::where('user_id', $user->id)
                    ->orderBy('created_at')
            ]);
        } else {
            return redirect('/login');
        }
    }

    public function getShoplistItems() {
        if (Auth::check()) {
            $user = Auth::user();
            $items = Shoplist::where('user_id', $user->id)
                ->join('products', 'products.id', '=', 'shoplist.item_id')
                ->select(
                    'shoplist.id as id', 
                    'shoplist.created_at as created_at',
                    'shoplist.updated_at as updated_at', 
                    'products.name as name', 
                    'products.price as price', 
                    'products.previous_price as previous_price', 
                    'products.img as img', 
                    'shoplist.quantity as quantity'
                    )
                ->orderBy('shoplist.created_at')
                ->get();
            return json_encode($items);
        } else {
            return json_encode(['success' => 0]);
        }
    }

    public function changeQuantity($id) {
        if (Auth::check()) {
            $user = Auth::user();
            $item = Shoplist::find($id);

            if (isset($_POST['quantity']) && $item->user_id == $user->id) {
                $item->quantity = $_POST['quantity'];
                $item->save();
                return json_encode(['success' => 1]);
            }
            return json_encode(['success' => 0]);
        }
    }

    public function addItemInShoplist($id) {
        if (Auth::check()) {
            $user = Auth::user();
            $item = Shoplist::where('user_id', $user->id)
                ->where('item_id', $id)
                ->get();
            if (count($item) > 0) {
                return json_encode(['success' => 1]);
            } else {
                $newItem = new Shoplist;
                $newItem->user_id = $user->id;
                $newItem->item_id = $id;
                $newItem->quantity = 1;
                $newItem->save();
                return json_encode(['success' => 1, 'id' => $newItem->id]);
            }
        } else {
            return json_encode(['success' => 0]);
        }
    }

    public function deleteItemFromShoplist($id) {
        if (Auth::check()) {
            $user = Auth::user();
            $item = Shoplist::find($id);
            if ($item && $item->user_id == $user->id) {
                $item->delete();
                return json_encode(['success' => 1]);
            } else {
                return json_encode(['success' => 0]);
            }
        } else {
            return json_encode(['success' => 0]);
        }
    }

    public function quit(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginConfirm(Request $request) 
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/personal');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ]);
    }

    public function registerConfirm(Request $request) {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'password' => 'required'
        ]);

        if (!User::where('email', $request->email)->exists()) {
            $new_user = new User;
            $new_user->name = $request->name;
            $new_user->last_name = $request->last_name;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->save();
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect('/personal');
            }
        }
        return back()->withErrors([
            'email' => 'The provided email is occupied'
        ]);
    }
}
