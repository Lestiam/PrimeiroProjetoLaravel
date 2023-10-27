<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function temporadas() //crio o relacionamento entre a Série e a Temporada
    {
        return $this->hasMany(Season::class, 'series_id'); //digo que uma série tem várias temporadas (1 para muitos)
    }

    protected static function booted() //crio um escopo global para ordenar as séries pelo nome
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
