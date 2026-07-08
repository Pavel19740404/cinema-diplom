<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $fillable = ['hall_id', 'film_id', 'date', 'start_time', 'price_standard', 'price_vip'];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}