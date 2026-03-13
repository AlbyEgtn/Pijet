<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{

    protected $fillable = [

        'hero_image',
        'hero_title',
        'hero_subtitle',

        'hero_button_text',
        'hero_button_link',

        'app_button_text',
        'app_button_link',

        'about_image',
        'about_title',
        'about_description',

        'service_title',
        'service_description',

        'therapist_title',
        'therapist_description',

        'join_title',
        'join_description',
        'join_image',

        'download_title',
        'download_description',
        'download_image'

    ];

}