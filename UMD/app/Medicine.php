<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'brand',
    ];

    public function category()
    {
        return $this->belongsTo('App\MedicineCategory');
    }
}
