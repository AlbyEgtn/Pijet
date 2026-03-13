<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingStatistic extends Model
{

    protected $table = 'landing_statistics';


    protected $fillable = [

        'title',
        'value'

    ];

}