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

    public function verifier()
    {
        return $this->belongsTo('App\Verifier');
    }

    public function feedback()
    {
        return $this->hasOne('App\Feedback');
    }
}
