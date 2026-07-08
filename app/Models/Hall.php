<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = ['name', 'rows', 'seats_per_row', 'is_open'];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }
}