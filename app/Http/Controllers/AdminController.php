<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        // if (auth()->check()) {
        //     return redirect()->to('home');
        // }
        return view('login');
    }
}
