<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    //

    public function index()
    {

        $users = User::all();
        //dd($users);
        return response()->json([
            'users' => $users,
        ], 200);
    }

}