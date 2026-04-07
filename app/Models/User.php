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
        'cabang_id',

        'city',
        'address',
        'foto',
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
        return $this->hasMany(\App\Models\Transaction::class, 'customer_id');
    }

    public function getKodeAttribute()
    {
        if ($this->role === 'admin') {
            return 'ADM' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
        }

        if ($this->role === 'finance') {
            return 'FNC' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
        }

        return $this->id;
    }
    public function cabang()
    {
        return $this->belongsTo(\App\Models\SuperAdmin\Cabang::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reported_user_id');
    }

    public function latestReport()
    {
        return $this->hasOne(Report::class, 'reported_user_id')->latestOfMany();
    }

}
