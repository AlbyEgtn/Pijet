<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TherapistProfile extends Model
{
    protected $table = 'therapist_profiles';

    protected $fillable = [
        'user_id',

        'experience_years',
        'skills',
        'certifications',
        'handle_special_condition',

        'work_days',
        'work_shifts',


        'city_id',
    ];

    protected $casts = [
        'handle_special_condition' => 'boolean',
        'is_mobile' => 'boolean',

        // otomatis jadi array
        'work_days' => 'array',
        'work_shifts' => 'array',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}