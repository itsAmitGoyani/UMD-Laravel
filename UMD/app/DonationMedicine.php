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

    public function donation()
    {
        return $this->belongsTo('App\Donation');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }

    public function expirations()
    {
        return $this->hasMany('App\DonationMedicineExpiration');
    }
}
