<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TherapistProfile extends Model
{
    protected $table = 'therapist_profiles';

    protected $fillable = [

        // FK
        'user_id',

        // KEMAMPUAN
        'experience_years',
        'skills',
        'certifications',
        'handle_special_condition',

        // KETERSEDIAAN
        'work_days',
        'work_hours',
        'is_mobile',
        'coverage_area',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'handle_special_condition' => 'boolean',
        'is_mobile' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}