<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadFeedback extends Model
{
    protected $fillable = [
        'id',
        'donator_id',
        'donation_id',
    ];
}
