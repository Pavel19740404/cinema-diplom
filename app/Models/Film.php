<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['title', 'description', 'duration', 'image'];

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }
}