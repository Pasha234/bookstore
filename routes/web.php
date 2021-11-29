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

Route::get('/', [Main::class, 'show']);

Route::get('/catalog', [Main::class, 'catalog']);

Route::get('/product/{id}', [Main::class, 'product']);

Route::get('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'register']);

Route::get('/order', [UserController::class, 'order']);

Route::get('/shoplist', [UserController::class, 'shoplist']);

Route::get('/personal', [UserController::class, 'personal']);