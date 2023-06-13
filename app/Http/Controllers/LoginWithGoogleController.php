<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginWithGoogleController extends Controller
{
    public function index()
    {
        return view('google/login');
    }

    public function login_page()
    {
        return view('google/login_page');
    }
}
