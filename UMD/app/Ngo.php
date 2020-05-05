<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ngo extends Model
{
    protected $fillable = [
        'id',
        'name', 
        'address', 
        'city',
        'state',
        'pincode',
        'dpd',
    ];

    public function manager()
    {
    	return $this->hasOne('App\Manager');
    }
}
