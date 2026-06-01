<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'reported_user_id',
        'reason',
        'description'
    ];

    // pelapor
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // terlapor
    public function reportedUser()
    {
        return $this->belongsTo(
            User::class,
            'reported_user_id'
        );
    }
}