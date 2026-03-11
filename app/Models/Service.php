<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'image',
        'is_additional',
        'is_active'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}