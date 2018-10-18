<?php

namespace App\Http\Controllers;
use App\User;
class UsersControllerPrueba extends Controller
{
    function index()
    {
        $user = new User();
        $user->name ='Melissa';
        $user->email ='meli.arroyoz@gmail.com';
        $user->password = 'ss';
        return response()->json([$user], 200);
    }
}
