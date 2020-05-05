<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineCategory extends Model
{
    protected $fillable = [
        'id',
        'categoryname',
    ];
}
