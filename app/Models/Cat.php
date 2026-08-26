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

    public function catReservations()
    {
        return $this->hasMany(CatReservation::class, 'cat_id');
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'cat_id');
    }
}
