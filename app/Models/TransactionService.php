<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionService extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaction_id',

        'service_name',

        'therapist_name',

        'duration',

        'service_price',

        'additional_service',

        'additional_price',

        'total_duration'

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

    public function getFormattedServicePriceAttribute()
    {
        return 'Rp' . number_format($this->service_price,0,',','.');
    }


    public function getFormattedAdditionalPriceAttribute()
    {
        return 'Rp' . number_format($this->additional_price,0,',','.');
    }

}