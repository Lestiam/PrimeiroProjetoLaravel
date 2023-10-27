<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function series() //series (singular) do inglês significa série (singular)
    {
        return $this->belongsTo(Serie::class); //belongsTo (pertence a) é o inverso do hasMany (tem muitos), ou seja, uma temporada pertence a uma série
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class); //hasMany (tem muitos) é o inverso do belongsTo (pertence a), ou seja, uma temporada tem muitos episódios
    }
}
