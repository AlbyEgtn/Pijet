<?php
namespace App\Models\Terapis;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Terapis extends Model
{

    protected $table = 'terapis';

    protected $fillable = [
        'user_id',
        'nik',
        'gender',
        'whatsapp',
        'address',
        'bank_name',
        'bank_number',
        'total_orders',
        'balance',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}