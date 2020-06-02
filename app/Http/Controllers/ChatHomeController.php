<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatHomeController extends Controller
{
    //

    
    public function index()
    {

        return view('chat');
    }
    
}