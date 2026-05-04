<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'name',
        'phone',
    ];

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}