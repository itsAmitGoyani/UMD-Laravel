<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStockExpiration extends Model
{
    protected $fillable = [
        'id',
        'medicine_stock_id',
        'expirydate',
        'qty',
    ];

    public function medicinestock()
    {
        return $this->belongsTo('App\MedicineStock');
    }
}
