<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'commission_id',
        'customer_id',
        'note',
        'status',
        'total',
    ];

    // 1 Order dimiliki oleh satu commission
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    // Order dimiliki oleh satu customer (user)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
