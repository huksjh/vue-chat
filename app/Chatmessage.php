<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatmessage extends Model
{
    //
    protected $guarded = [];

    public function from()
    {
        # code...
        return $this->belongsTo(User::class, 'from');

    }

    public function to()
    {
        # code...
        return $this->belongsTo(User::class, 'to');
    }

}