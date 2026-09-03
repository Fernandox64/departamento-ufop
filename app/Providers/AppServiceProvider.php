<?php

namespace App\Providers;

use App\Support\ContentDefaults;
use App\Support\ContentStore;
use App\Support\EventoStore;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        // Login do admin: no maximo 5 tentativas por minuto, contando por
        // e-mail tentado + IP (bloqueia forca bruta sem travar todo mundo se
        // um IP compartilhado tiver outro uso legitimo).
        RateLimiter::for('login', function (Request $request) {
            $chave = strtolower((string) $request->input('email')).'|'.$request->ip();

            return Limit::perMinute(5)->by($chave);
        });

        View::composer('*', function ($view) {
            $tema = ContentStore::get('tema', ContentDefaults::tema());

            $view->with('siteSettings', ContentStore::get('configuracoes', ContentDefaults::configuracoes()));
            $view->with('siteTheme', ContentDefaults::paletaTema($tema['paleta'] ?? ''));
            $view->with('siteThemeKey', $tema['paleta'] ?? ContentDefaults::tema()['paleta']);
            $view->with('siteThemeOptions', array_replace(ContentDefaults::tema(), $tema));
            $view->with('rodape', ContentStore::get('rodape', ContentDefaults::rodape()));
            $view->with('menuGraduacao', ContentStore::get('graduacao', ContentDefaults::graduacao()));
            $view->with('menuPosGraduacao', ContentStore::get('pos_graduacao', ContentDefaults::posGraduacao()));
            $view->with('menuEventosVisivel', EventoStore::mostrarMenu());
            $view->with('menuPessoal', ContentStore::get('pessoal', ContentDefaults::pessoal()));
        });
    }
}
