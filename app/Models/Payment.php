<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_id',

        'bank_name',

        'account_number',

        'account_holder',

        'payment_proof',

        'paid_at'

    ];



    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }



    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getFormattedPaidAtAttribute()
    {
        if(!$this->paid_at) return '-';

        return date('d M Y H:i', strtotime($this->paid_at));
    }

}