<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->to('/');
        }
        else{
            return view('login');
        }
    }
}
