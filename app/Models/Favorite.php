<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'favoritable_id',
        'favoritable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function getFavoritableAttribute()
    {
        if ($this->favoritable_type === 'cat') {
            return Cat::find($this->favoritable_id);
        }

        if ($this->favoritable_type === 'product') {
            return Product::find($this->favoritable_id);
        }

        return null;
    }
}