<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'id',
        'donator_id',
        'ngo_id',
        'pickupman_id',
        'datetime',
        'status',
        'verifier_id',
    ];
}
