<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\EventoController as AdminEventoController;
use App\Http\Controllers\Admin\NoticiaController as AdminNoticiaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/servicos', [SiteController::class, 'servicos'])->name('servicos');
Route::get('/graduacao', [SiteController::class, 'graduacao'])->name('graduacao');
Route::get('/pos-graduacao', [SiteController::class, 'posGraduacao'])->name('pos-graduacao');
Route::get('/equipe', [SiteController::class, 'equipe'])->name('equipe');
Route::get('/contato', [SiteController::class, 'contato'])->name('contato');

Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{id}', [NoticiaController::class, 'show'])->name('noticias.show');

Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt')->middleware('throttle:login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin.auth', 'admin.audit'])->group(function () {
        Route::get('/', [AdminContentController::class, 'dashboard'])->name('dashboard');

        Route::get('/configuracoes', [AdminContentController::class, 'configuracoesEdit'])->name('configuracoes.edit');
        Route::post('/configuracoes', [AdminContentController::class, 'configuracoesUpdate'])->name('configuracoes.update');

        Route::get('/rodape', [AdminContentController::class, 'rodapeEdit'])->name('rodape.edit');
        Route::post('/rodape', [AdminContentController::class, 'rodapeUpdate'])->name('rodape.update');

        Route::get('/home', [AdminContentController::class, 'homeEdit'])->name('home.edit');
        Route::post('/home', [AdminContentController::class, 'homeUpdate'])->name('home.update');

        Route::get('/carrossel', [AdminContentController::class, 'carrosselEdit'])->name('carrossel.edit');
        Route::post('/carrossel', [AdminContentController::class, 'carrosselUpdate'])->name('carrossel.update');

        Route::get('/sobre', [AdminContentController::class, 'sobreEdit'])->name('sobre.edit');
        Route::post('/sobre', [AdminContentController::class, 'sobreUpdate'])->name('sobre.update');

        Route::get('/servicos', [AdminContentController::class, 'servicosEdit'])->name('servicos.edit');
        Route::post('/servicos', [AdminContentController::class, 'servicosUpdate'])->name('servicos.update');

        Route::get('/graduacao', [AdminContentController::class, 'graduacaoEdit'])->name('graduacao.edit');
        Route::post('/graduacao', [AdminContentController::class, 'graduacaoUpdate'])->name('graduacao.update');

        Route::get('/pos-graduacao', [AdminContentController::class, 'posGraduacaoEdit'])->name('pos-graduacao.edit');
        Route::post('/pos-graduacao', [AdminContentController::class, 'posGraduacaoUpdate'])->name('pos-graduacao.update');

        Route::get('/equipe', [AdminContentController::class, 'equipeEdit'])->name('equipe.edit');
        Route::post('/equipe', [AdminContentController::class, 'equipeUpdate'])->name('equipe.update');

        Route::get('/contato', [AdminContentController::class, 'contatoEdit'])->name('contato.edit');
        Route::post('/contato', [AdminContentController::class, 'contatoUpdate'])->name('contato.update');

        Route::get('/noticias', [AdminNoticiaController::class, 'index'])->name('noticias.index');
        Route::get('/noticias/criar', [AdminNoticiaController::class, 'create'])->name('noticias.create');
        Route::post('/noticias', [AdminNoticiaController::class, 'store'])->name('noticias.store');
        Route::get('/noticias/{id}/editar', [AdminNoticiaController::class, 'edit'])->name('noticias.edit');
        Route::put('/noticias/{id}', [AdminNoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('/noticias/{id}', [AdminNoticiaController::class, 'destroy'])->name('noticias.destroy');

        Route::get('/eventos', [AdminEventoController::class, 'index'])->name('eventos.index');
        Route::post('/eventos/visibilidade', [AdminEventoController::class, 'updateVisibilidade'])->name('eventos.visibilidade');
        Route::get('/eventos/criar', [AdminEventoController::class, 'create'])->name('eventos.create');
        Route::post('/eventos', [AdminEventoController::class, 'store'])->name('eventos.store');
        Route::get('/eventos/{id}/editar', [AdminEventoController::class, 'edit'])->name('eventos.edit');
        Route::put('/eventos/{id}', [AdminEventoController::class, 'update'])->name('eventos.update');
        Route::delete('/eventos/{id}', [AdminEventoController::class, 'destroy'])->name('eventos.destroy');
    });
});
