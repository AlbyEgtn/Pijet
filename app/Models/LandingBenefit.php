<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingBenefit extends Model
{

    protected $table = 'landing_benefits';


    protected $fillable = [

        'title',
        'description',
        'icon'

    ];

}