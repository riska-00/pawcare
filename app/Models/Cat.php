<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable = [
        'name',
        'breed',
        'age',
        'gender',
        'price',
        'photo',
        'description',
        'status'
    ];

    protected function casts(): array
    {
        return ['price' => 'decimal:2'];
    }

    public function catReservations()
    {
        return $this->hasMany(CatReservation::class, 'cat_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'favoritable_id')->where('favoritable_type', 'cat');
    }
}