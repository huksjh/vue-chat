<?php

namespace App\Http\Controllers;

use App\Chatmessage;
use App\Events\ChatMessageSent;
use Illuminate\Http\Request;

class ChatmessageController extends Controller
{
    //

    public function index()
    {

        $messages = Chatmessage::where(function ($query) {
            $query->where('from', request('from'));
            $query->where('to', request('to'));
        })->orWhere(function ($query) {
            $query->where('from', request('to'));
            $query->where('to', request('from'));
        })->get();

        //dd(request()->all());

        return response()->json([
            'messages' => $messages->load('from', 'to'),
        ], 200);

    }

    //등록
    public function store()
    {
        # code...

        //데이터 검사
        $validate = request()->validate([
            'content' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $messages = Chatmessage::create($validate);

        ChatMessageSent::dispatch($messages->load('from'));

        return response()->json([
            'messages' => $messages->load('from'),
        ], 201);

    }

}