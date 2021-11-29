<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function personal() {
        return view('user.personal');
    }

    public function login() {
        return view('user.login');
    }

    public function register() {
        return view('user.register');
    }

    public function order() {
        return view('user.order');
    }

    public function shoplist() {
        return view('user.shoplist');
    }

    public function quit() {
        
    }

    public function loginConfirm() {
        
    }
}
