<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'day_rate',
        'night_rate',
    ];

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}