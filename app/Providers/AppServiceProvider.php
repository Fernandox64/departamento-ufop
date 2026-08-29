<?php

namespace App\Providers;

use App\Support\ContentDefaults;
use App\Support\ContentStore;
use App\Support\EventoStore;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('siteSettings', ContentStore::get('configuracoes', ContentDefaults::configuracoes()));
            $view->with('rodape', ContentStore::get('rodape', ContentDefaults::rodape()));
            $view->with('menuGraduacao', ContentStore::get('graduacao', ContentDefaults::graduacao()));
            $view->with('menuPosGraduacao', ContentStore::get('pos_graduacao', ContentDefaults::posGraduacao()));
            $view->with('menuEventosVisivel', EventoStore::mostrarMenu());
        });
    }
}
