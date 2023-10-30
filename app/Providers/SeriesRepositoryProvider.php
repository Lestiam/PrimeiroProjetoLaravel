<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class //Eu estou dizendo, sempre que eu precisar de uma instância de SeriesRepository, eu quero que você me dê uma instância de EloquentSeriesRepository. Depois tenho que adiciona-lo nas configurações/app. key => providers
    ];
}
