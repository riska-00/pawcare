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

    protected function casts(): array
    {
        return ['visit_date' => 'date'];
    }

    public function getKodeReservasiAttribute()
    {
        return 'RES' . $this->created_at->format('dmy') . '-' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id');
    }

}