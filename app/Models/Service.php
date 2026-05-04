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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://via.placeholder.com/400x200';
        }

        // full URL
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // 🔥 UNSPLASH DETECTION (LEBIH AKURAT)
        if (!str_contains($this->image, '/') && !str_contains($this->image, '.')) {
            return "https://images.unsplash.com/photo-{$this->image}?auto=format&fit=crop&w=400&q=70";
        }

        // local storage
        return asset('storage/' . $this->image);
    }
}