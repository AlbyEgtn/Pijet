<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'terapis_id',       // ← tambahkan kolom ini via migration (lihat catatan)
        'bank_name',
        'account_number',
        'account_holder',
        'balance',
        'is_active'
    ];

    /*
    |----------------------------------------------------------------------
    | SCOPES
    |----------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function terapis()
    {
        return $this->belongsTo(Terapis::class);
    }
}