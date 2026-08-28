<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'shipping_address',
        'total_price',
        'payment_method',
        'status',
    ];

    protected function casts(): array
    {
        return ['total_price' => 'decimal:2'];
    }

    public function getKodePesananAttribute()
    {
        return 'PC' . $this->created_at->format('dmy') . '-' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id');
    }
}