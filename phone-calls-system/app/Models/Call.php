<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'subscriber_id',
        'city_id',
        'phone',
        'duration',
        'price',
        'call_time'
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}