<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'donation_id',
        'description',
    ];

    public function donation()
    {
        return $this->belongsTo('App\Donation');
    }

    public function category()
    {
        return $this->belongsTo('App\FeedbackCategory');
    }
}
