<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nik',
        'gender',
        'birth_date',
        'phone',
        'city_id',
        'address',
        'ktp',
        'skck',
        'email_otp',
        'otp_expired_at',
        'verification_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function therapistProfile()
    {
        return $this->hasOne(TherapistProfile::class);
    }

    public function terapis()
    {
        return $this->hasOne(Terapis::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cabang()
    {
        return $this->belongsTo(\App\Models\SuperAdmin\Cabang::class, 'cabang_id');
    }

}
