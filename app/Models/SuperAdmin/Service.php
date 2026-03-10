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
}