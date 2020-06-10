<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'id',
        'message',
        'name',
        'email',
        'subject',
    ];
}
