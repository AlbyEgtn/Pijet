<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TherapistReview extends Model
{
    protected $fillable = [

        'customer_id',
        'therapist_id',
        'rating',
        'review',
    ];

    // ======================
    // RELATION
    // ======================

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}