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
        'work_hours',
        'is_mobile',
        'coverage_area',
    ];

    protected $casts = [
        'handle_special_condition' => 'boolean',
        'is_mobile' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}