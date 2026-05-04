<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

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

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}