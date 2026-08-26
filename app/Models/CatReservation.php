<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatReservation extends Model
{
    protected $fillable = [
        'user_id',
        'cat_id',
        'visit_date',
        'notes',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id');
    }
    
}
