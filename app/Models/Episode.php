<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number']; //digo que o campo number pode ser preenchido em massa
    public $timestamps = false; //digo que não quero que o laravel crie os campos created_at e updated_at no banco de dados

    public function season()
    {
        return $this->belongsTo(Season::class); //belongsTo (pertence a) é o inverso do hasMany (tem muitos), ou seja, um episódio pertence a uma temporada
    }
}
