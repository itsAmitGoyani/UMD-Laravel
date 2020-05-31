<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    protected $fillable = [
        'id',
        'ngo_id',
        'medicine_id',
        'qty',
    ];

    public function ngo()
    {
        return $this->belongsTo('App\Ngo');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }
}
