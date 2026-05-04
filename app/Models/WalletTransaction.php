<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $table = 'wallet_transactions';

    protected $fillable = [
        'payment_account_id',
        'type',
        'amount',
        'reference_type',
        'reference_id',
        'description',
    ];

    const TYPE_INCOME  = 'income';
    const TYPE_EXPENSE = 'expense';

    public function paymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class);
    }

    public function reference()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }

    public function scopeIncome($query)
    {
        return $query->where('type', self::TYPE_INCOME);
    }

    public function scopeExpense($query)
    {
        return $query->where('type', self::TYPE_EXPENSE);
    }

    public function isIncome()
    {
        return $this->type === self::TYPE_INCOME;
    }

    public function isExpense()
    {
        return $this->type === self::TYPE_EXPENSE;
    }
}