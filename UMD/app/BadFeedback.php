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
    public function donator()
    {
        return $this->belongsTo('App\Donator');
    }
    public function donation()
    {
        return $this->belongsTo('App\Donation');
    }
}
