<?php

namespace App\Http\Controllers;
use App\User;
class HomeController extends Controller
{
    public function home()
    {
    	return view('home');
    }
}
