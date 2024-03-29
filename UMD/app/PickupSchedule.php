<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupSchedule extends Model
{
    protected $fillable = [
        'id',
        'donator_id',
        'ngo_id',
        'date',
        'status',
        'pickupman_id',
    ];

    public function donator()
    {
        return $this->belongsTo('App\Donator');
    }

    public function ngo()
    {
        return $this->belongsTo('App\Ngo');
    }

    public function pickupman()
    {
        return $this->belongsTo('App\Pickupman');
    }
}
