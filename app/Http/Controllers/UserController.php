<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shoplist;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Google\Client;
use Google\Service\Oauth2;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function personal() {
        if (Auth::check()){
            $user = Auth::user();
            return view('user.personal',[
                'user' => Auth::user()
            ]);
        } else {
            return redirect('/login');
        }
    }

    public function login(Request $request) {
        if (Auth::check()) {
            return redirect('/personal');
        } else {
            $redirect_uri = url()->current();
            $client_id = config('login.clientId');
            $client_secret = config('login.clientSecret');
            $client = new Client();
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect_uri);
            $client->setScopes('profile');
            $client->setScopes('email');
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $auth = new Oauth2($client);
                $google_info = $auth->userinfo->get();
                $email = $google_info->email;
                $name = $google_info->name;
                $user = User::where('email', $email)
                    ->where('from_google', true)
                    ->first();

                if ($user) {
                    Auth::loginUsingId($user->id);
                    $request->session()->regenerate();
        
                    return redirect('/personal');
                }
                $request->session()->forget('id_token_token');
                return redirect('/login')->withErrors([
                    'email' => 'The provided credentials do not match our records'
                ]);
            } else {
                return view('user.login', [
                    'google_link' => $client->createAuthUrl()
                ]);
            }
        }
    }

    public function register(Request $request) {
        if (Auth::check()) {
            return redirect('/personal');
        } else {
            $redirect_uri = url()->current();
            $client_id = config('login.clientId');
            $client_secret = config('login.clientSecret');
            $client = new Client();
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect_uri);
            $client->setScopes('profile');
            $client->setScopes('email');
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);
                $auth = new Oauth2($client);
                $google_info = $auth->userinfo->get();
                $email = $google_info->email;
                $name = $google_info->name;
                $user = User::where('email', $email)
                    ->first();

                if ($user) {
                    if ($user['from_google'] == false) {
                        return redirect('/register')->withErrors([
                            'email' => 'The provided email is occupied'
                        ]);
                    }
                    Auth::loginUsingId($user->id);
                    $request->session()->regenerate();
        
                    return redirect('/personal');
                } else {
                    $request->session()->push('email', $email);
                    $request->session()->push('from_google', true);
                    return redirect('/register/from_google');
                }
                $request->session()->forget('id_token_token');
                return redirect('/login')->withErrors([
                    'email' => 'The provided credentials do not match our records'
                ]);
            } else {
                return view('user.register', [
                    'google_link' => $client->createAuthUrl()
                ]);
            }
        }
    }

    public function order($id) {
        $order = Order::find($id);

        $order_items = Order_item::where('order_items.order_id', $id)
        ->join('products', 'order_items.product_id', 'products.id')
        ->select('products.*',
        'order_items.quantity')
        ->get();

        if (Auth::check()) {
            return view('user.order', [
                'order' => $order,
                'order_items' => $order_items,
                'user' => Auth::user()
            ]);
        } else {
            return view('user.order', [
                'order' => $order,
                'order_items' => $order_items
            ]);
        }
        
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

        $request->session()->forget('id_token_token');

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

        $user = User::firstWhere('email', $request->email);
        if ($user->from_google == 0) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/personal');
            }
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

    public function getUserOrders() {
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())
                ->get();
            return json_encode($orders);
        }
        return json_encode(['success' => false]);
    }

    public function storeAvatar(Request $request) {
        if (!Auth::check()) {
            return response()->json(['success' => false]);
        }
        if ($request->file('avatar')->isValid()) {
            $imgName = uniqid() . '.jpg';
            $path = $request->file('avatar')->storeAs('public', $imgName);
            $pathToImg = $_SERVER['DOCUMENT_ROOT'] . '/../storage/app/' . $path;
            $image = Image::make($pathToImg);
            if ($image->height() > $image->width()) {
                $image->widen(300);
            } else {
                $image->heighten(300);
            }
            $image->crop(300, 300)->save();
            $user = Auth::user();
            if ($user->img) {
                Storage::disk('public')->delete($user->img);
            }
            $user->img = $imgName;
            $user->save();
            return response()->json(['success' => true, 'img' => $imgName]);
        }
    }

    public function registerFromGoogle(Request $request) {
        if (Auth::check()) {
            return redirect('/personal');
        } else {
            if ($request->session()->has('email') && $request->session()->has('from_google')) {
                if ($request->session()->get('from_google') == true){
                    return view('user.googleRegister');
                }
            }
        }
        return redirect('/home');
    }

    public function registerFromGoogleConfirm(Request $request) {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:100']
        ]);
        if (!$request->session()->has('email') || !$request->session()->has('from_google')) {
            return redirect('/home');
        }
        if ($request->session()->get('from_google') != true){
            return redirect('/home');
        }

        if (!User::where('email', $request->email)->exists()) {
            $new_user = new User;
            $new_user->name = $request->name;
            $new_user->last_name = $request->last_name;
            $new_user->email = $request->session()->get('email')[0];
            $new_user->password = null;
            $new_user['from_google'] = true;
            $new_user->save();
            $request->session()->forget(['email', 'from_google']);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
    
                return redirect('/personal');
            }
        }
        return back()->withErrors([
            'email' => 'The provided email is occupied'
        ]);
    }

    public function addFeedback(Request $request) {
        if (Auth::check()) {
        $credentials = $request->validate([
            'user_id' => ['required', 'integer'],
            'product_id' => ['required', 'integer'],
            'grade' => ['required', 'integer', 'max:5', 'min:1'],
            'text' => ['string', 'max:400']
        ]);
        return $credentials;
        } else {
            return response()->json(['success' => 0]);
        }
        
    }
}
