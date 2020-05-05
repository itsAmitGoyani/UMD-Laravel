<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationMedicineExpiration extends Model
{
    protected $fillable = [
        'id',
        'donation_medicine_id',
        'expirydate',
        'qty',
    ];
}
