<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'photo',
        'description',
    ];

    protected function casts(): array
    {
        return ['price' => 'decimal:2'];
    }

     public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'favoritable_id')->where('favoritable_type', 'product');
    }

}