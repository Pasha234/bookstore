<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Main::class, 'main']);

Route::get('/catalog', [Main::class, 'catalog']);

Route::get('/product/{id}', [Main::class, 'product']);

Route::get('/login', [UserController::class, 'login']);

Route::post('/login', [UserController::class, 'loginConfirm']);

Route::get('/register', [UserController::class, 'register']);

Route::post('/register', [UserController::class, 'registerConfirm']);

Route::get('/quit', [UserController::class, 'quit']);

Route::get('/order', [UserController::class, 'order']);

Route::get('/shoplist', [UserController::class, 'shoplist']);

Route::get('/personal', [UserController::class, 'personal']);

Route::get('/{category}/search', [Main::class, 'search']);

Route::get('/offer/{id}', [Main::class, 'offer']);

Route::get('/order/{id}', [UserController::class, 'order']);

Route::prefix('api')->group(function() {
    Route::post('/shoplist/{id}/add', [UserController::class, 'addItemInShoplist']);

    Route::post('/shoplist/{id}/change_quantity', [UserController::class, 'changeQuantity']);

    Route::post('/shoplist/{id}/delete', [UserController::class, 'deleteItemFromShoplist']);

    Route::get('/shoplist', [UserController::class, 'getShoplistItems']);

    Route::get('/products/getDiscountProducts', [Main::class, 'getDiscountProducts']);

    Route::get('/products/{id}/getSimiliarItems', [Main::class, 'getSimiliarItems']);

    Route::get('/orders', [UserController::class, 'getUserOrders']);

    Route::get('/offer/{id}/items', [Main::class, 'getOfferItems']);

    Route::get('/{category}/search', [Main::class, 'getSearchedItems']);

    Route::post('/personal/changeAvatar', [UserController::class, 'storeAvatar']);
});
