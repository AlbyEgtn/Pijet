<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_code',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_city',

        'orderer_name',

        'service_date',
        'service_time',

        'payment_method',
        'payment_expired_at',
        'payment_uploaded_at',

        'status',

        'total_price',

        'reschedule_date',
        'reschedule_time',

        'cancel_reason'
    ];



    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function services()
    {
        return $this->hasMany(TransactionService::class);
    }


    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }


    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp' . number_format($this->total_price,0,',','.');
    }


    public function getStatusBadgeAttribute()
    {

        return match($this->status) {

            'lunas' => 'bg-blue-500 text-white',

            'belum_lunas' => 'bg-gray-400 text-white',

            'dibatalkan' => 'bg-red-500 text-white',

            'reschedule' => 'bg-yellow-500 text-white',

            default => 'bg-gray-200'

        };

    }



    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function serviceCount()
    {
        return $this->services()->count();
    }

}