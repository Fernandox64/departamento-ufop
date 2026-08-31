<?php

namespace App\Http\Controllers;

use App\Support\ContentDefaults;
use App\Support\ContentStore;
use App\Support\EventoStore;
use App\Support\NoticiaStore;

class SiteController extends Controller
{
    public function home()
    {
        $content = ContentStore::get('home', ContentDefaults::home());
        $carrossel = ContentStore::get('carrossel', ContentDefaults::carrossel());
        $mostrarEventos = EventoStore::mostrarMenu();
        $noticias = NoticiaStore::latest($mostrarEventos ? 4 : 6);
        $eventos = $mostrarEventos ? EventoStore::upcoming(5) : [];

        return view('site.home', compact('content', 'carrossel', 'noticias', 'eventos', 'mostrarEventos'));
    }

    public function sobre()
    {
        $content = ContentStore::get('sobre', ContentDefaults::sobre());

        return view('site.sobre', compact('content'));
    }

    public function servicos()
    {
        $content = ContentStore::get('servicos', ContentDefaults::servicos());

        return view('site.servicos', compact('content'));
    }

    public function graduacao()
    {
        $content = ContentStore::get('graduacao', ContentDefaults::graduacao());

        return view('site.graduacao', compact('content'));
    }

    public function posGraduacao()
    {
        $content = ContentStore::get('pos_graduacao', ContentDefaults::posGraduacao());

        return view('site.pos-graduacao', compact('content'));
    }

    public function pessoalDocentes()
    {
        return $this->pessoalPorCategoria('docente', 'Docentes');
    }

    public function pessoalFuncionarios()
    {
        return $this->pessoalPorCategoria('funcionario', 'Funcionarios');
    }

    protected function pessoalPorCategoria(string $categoria, string $tituloPagina)
    {
        $content = ContentStore::get('pessoal', ContentDefaults::pessoal());
        $content['membros'] = array_values(array_filter(
            $content['membros'],
            fn ($membro) => ($membro['categoria'] ?? 'docente') === $categoria
        ));
        $content['titulo'] = $tituloPagina;

        return view('site.pessoal', compact('content'));
    }

    public function contato()
    {
        $content = ContentStore::get('contato', ContentDefaults::contato());

        return view('site.contato', compact('content'));
    }
}
