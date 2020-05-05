<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationMedicine extends Model
{
    protected $fillable = [
        'id',
        'donation_id',
        'medicine_id',
        'qty',
    ];
}
