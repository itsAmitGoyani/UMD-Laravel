<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'donation_id',
        'description',
    ];
}
