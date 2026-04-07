<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_code',

        'customer_id',
        'terapis_id',

        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_city',

        'orderer_name',

        'company_account_id',

        'company_income',
        'therapist_income',

        'is_balance_recorded',   // ✅ tambahan
        'is_profit_shared',      // ✅ tambahan

        'service_date',
        'service_time',

        'payment_method',

        'payment_status',
        'payment_uploaded_at',
        'payment_verified_at',
        'payment_expired_at',
        'payment_proof',

        'order_status',

        'total_price',

        'reschedule_date',
        'reschedule_time',

        'cancel_reason',

        'expired_at',

        'started_at',   // ✅ tambahan
        'completed_at', // ✅ tambahan
    ];

    protected $casts = [
        'service_date' => 'date',
        'service_time' => 'datetime:H:i',

        'payment_uploaded_at' => 'datetime',
        'payment_verified_at' => 'datetime',
        'payment_expired_at' => 'datetime',
        'expired_at' => 'datetime',

        'started_at' => 'datetime',     // ✅ tambahan
        'completed_at' => 'datetime',   // ✅ tambahan

        'is_balance_recorded' => 'boolean', // ✅ tambahan
        'is_profit_shared' => 'boolean',    // ✅ tambahan
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

    public function companyAccount()
    {
        return $this->belongsTo(PaymentAccount::class, 'company_account_id');
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

    public function getServiceCountAttribute()
    {
        return $this->services->count();
    }

    public function getTherapistFilledAttribute()
    {
        return $this->services->whereNotNull('therapist_id')->count();
    }

    public function getExecutionDateAttribute()
    {
        return $this->service_date
            ? Carbon::parse($this->service_date)->format('d M Y')
            : '-';
    }

    public function getStatusAttribute()
    {
        return $this->payment_status;
    }
}