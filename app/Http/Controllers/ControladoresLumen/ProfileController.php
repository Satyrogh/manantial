<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function verPerfil(){
        $user = User::where('username', '123')->first();
        Auth::once(['username' => $user->username, 'password' => $user->password]);
    }
}
