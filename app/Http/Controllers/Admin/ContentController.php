<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ContentDefaults;
use App\Support\ContentStore;
use App\Support\ImageUploader;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function dashboard()
    {
        $secoes = [
            ['chave' => 'configuracoes', 'titulo' => 'Configuracoes gerais', 'rota' => 'admin.configuracoes.edit'],
            ['chave' => 'rodape', 'titulo' => 'Rodape do site', 'rota' => 'admin.rodape.edit'],
            ['chave' => 'home', 'titulo' => 'Pagina inicial', 'rota' => 'admin.home.edit'],
            ['chave' => 'carrossel', 'titulo' => 'Carrossel de imagens', 'rota' => 'admin.carrossel.edit'],
            ['chave' => 'noticias', 'titulo' => 'Noticias e Editais', 'rota' => 'admin.noticias.index'],
            ['chave' => 'eventos', 'titulo' => 'Eventos', 'rota' => 'admin.eventos.index'],
            ['chave' => 'sobre', 'titulo' => 'Sobre o departamento', 'rota' => 'admin.sobre.edit'],
            ['chave' => 'servicos', 'titulo' => 'Servicos', 'rota' => 'admin.servicos.edit'],
            ['chave' => 'graduacao', 'titulo' => 'Graduacao', 'rota' => 'admin.graduacao.edit'],
            ['chave' => 'pos_graduacao', 'titulo' => 'Pos-Graduacao', 'rota' => 'admin.pos-graduacao.edit'],
            ['chave' => 'equipe', 'titulo' => 'Equipe', 'rota' => 'admin.equipe.edit'],
            ['chave' => 'contato', 'titulo' => 'Contato', 'rota' => 'admin.contato.edit'],
        ];

        return view('admin.dashboard', compact('secoes'));
    }

    // ---------------------------------------------------------------
    // Configuracoes gerais
    // ---------------------------------------------------------------

    public function configuracoesEdit()
    {
        $content = ContentStore::get('configuracoes', ContentDefaults::configuracoes());

        return view('admin.sections.configuracoes', compact('content'));
    }

    public function configuracoesUpdate(Request $request)
    {
        $data = $request->validate([
            'nome_site' => ['required', 'string', 'max:150'],
            'sigla' => ['nullable', 'string', 'max:20'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'logo_arquivo' => ['nullable', 'image', 'max:2048'],
        ]);

        $atual = ContentStore::get('configuracoes', ContentDefaults::configuracoes());

        $data['logo'] = ImageUploader::store($request->file('logo_arquivo'), $atual['logo']);
        unset($data['logo_arquivo']);

        ContentStore::save('configuracoes', $data);

        return back()->with('status', 'Configuracoes atualizadas com sucesso.');
    }

    // ---------------------------------------------------------------
    // Rodape do site
    // ---------------------------------------------------------------

    public function rodapeEdit()
    {
        $content = ContentStore::get('rodape', ContentDefaults::rodape());

        return view('admin.sections.rodape', compact('content'));
    }

    public function rodapeUpdate(Request $request)
    {
        $data = $request->validate([
            'texto' => ['nullable', 'string', 'max:500'],
            'copyright' => ['nullable', 'string', 'max:150'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:150'],
            'logo_arquivo' => ['nullable', 'image', 'max:2048'],
        ]);

        $atual = ContentStore::get('rodape', ContentDefaults::rodape());

        $data['logo'] = ImageUploader::store($request->file('logo_arquivo'), $atual['logo']);
        unset($data['logo_arquivo']);

        ContentStore::save('rodape', $data);

        return back()->with('status', 'Rodape atualizado com sucesso.');
    }

    // ---------------------------------------------------------------
    // Pagina inicial
    // ---------------------------------------------------------------

    public function homeEdit()
    {
        $content = ContentStore::get('home', ContentDefaults::home());

        return view('admin.sections.home', compact('content'));
    }

    public function homeUpdate(Request $request)
    {
        $data = $request->validate([
            'hero_titulo' => ['required', 'string', 'max:150'],
            'hero_subtitulo' => ['nullable', 'string', 'max:255'],
            'sobre_titulo' => ['nullable', 'string', 'max:150'],
            'sobre_texto' => ['nullable', 'string', 'max:1000'],
            'destaques' => ['array'],
            'destaques.*.icone' => ['nullable', 'string', 'max:60'],
            'destaques.*.titulo' => ['nullable', 'string', 'max:100'],
            'destaques.*.texto' => ['nullable', 'string', 'max:255'],
        ]);

        $data['destaques'] = $this->removerLinhasVazias($data['destaques'] ?? []);

        ContentStore::save('home', $data);

        return back()->with('status', 'Pagina inicial atualizada com sucesso.');
    }

    // ---------------------------------------------------------------
    // Carrossel de imagens (pagina inicial)
    // ---------------------------------------------------------------

    public function carrosselEdit()
    {
        $content = ContentStore::get('carrossel', ContentDefaults::carrossel());

        return view('admin.sections.carrossel', compact('content'));
    }

    public function carrosselUpdate(Request $request)
    {
        $data = $request->validate([
            'slides' => ['array'],
            'slides.*.legenda' => ['nullable', 'string', 'max:150'],
            'slides.*.imagem_arquivo' => ['nullable', 'image', 'max:4096'],
        ]);

        $atual = ContentStore::get('carrossel', ContentDefaults::carrossel());
        $slidesAtuais = $atual['slides'] ?? [];

        $slides = [];
        foreach ($data['slides'] ?? [] as $idx => $slide) {
            $legenda = trim((string) ($slide['legenda'] ?? ''));
            $imagemAtual = $slidesAtuais[$idx]['imagem'] ?? '';
            $imagem = ImageUploader::store($request->file("slides.$idx.imagem_arquivo"), $imagemAtual);

            if ($imagem === '') {
                continue;
            }

            $slides[] = ['imagem' => $imagem, 'legenda' => $legenda];
        }

        ContentStore::save('carrossel', ['slides' => $slides]);

        return back()->with('status', 'Carrossel atualizado com sucesso.');
    }

    // ---------------------------------------------------------------
    // Sobre
    // ---------------------------------------------------------------

    public function sobreEdit()
    {
        $content = ContentStore::get('sobre', ContentDefaults::sobre());

        return view('admin.sections.sobre', compact('content'));
    }

    public function sobreUpdate(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'texto_intro' => ['nullable', 'string', 'max:500'],
            'texto_corpo' => ['nullable', 'string', 'max:4000'],
            'destaques' => ['array'],
            'destaques.*' => ['nullable', 'string', 'max:150'],
            'imagem_arquivo' => ['nullable', 'image', 'max:2048'],
        ]);

        $atual = ContentStore::get('sobre', ContentDefaults::sobre());

        $data['imagem'] = ImageUploader::store($request->file('imagem_arquivo'), $atual['imagem']);
        unset($data['imagem_arquivo']);
        $data['destaques'] = array_values(array_filter($data['destaques'] ?? [], fn ($v) => trim((string) $v) !== ''));

        ContentStore::save('sobre', $data);

        return back()->with('status', 'Pagina "Sobre" atualizada com sucesso.');
    }

    // ---------------------------------------------------------------
    // Servicos
    // ---------------------------------------------------------------

    public function servicosEdit()
    {
        $content = ContentStore::get('servicos', ContentDefaults::servicos());

        return view('admin.sections.servicos', compact('content'));
    }

    public function servicosUpdate(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'introducao' => ['nullable', 'string', 'max:500'],
            'itens' => ['array'],
            'itens.*.icone' => ['nullable', 'string', 'max:60'],
            'itens.*.titulo' => ['nullable', 'string', 'max:100'],
            'itens.*.texto' => ['nullable', 'string', 'max:255'],
        ]);

        $data['itens'] = $this->removerLinhasVazias($data['itens'] ?? []);

        ContentStore::save('servicos', $data);

        return back()->with('status', 'Pagina "Servicos" atualizada com sucesso.');
    }

    // ---------------------------------------------------------------
    // Graduacao / Pos-Graduacao
    // ---------------------------------------------------------------

    public function graduacaoEdit()
    {
        $content = ContentStore::get('graduacao', ContentDefaults::graduacao());

        return view('admin.sections.cursos', [
            'content' => $content,
            'tituloPagina' => 'Graduacao',
            'updateRoute' => 'admin.graduacao.update',
        ]);
    }

    public function graduacaoUpdate(Request $request)
    {
        $this->salvarPaginaCursos($request, 'graduacao');

        return back()->with('status', 'Pagina "Graduacao" atualizada com sucesso.');
    }

    public function posGraduacaoEdit()
    {
        $content = ContentStore::get('pos_graduacao', ContentDefaults::posGraduacao());

        return view('admin.sections.cursos', [
            'content' => $content,
            'tituloPagina' => 'Pos-Graduacao',
            'updateRoute' => 'admin.pos-graduacao.update',
        ]);
    }

    public function posGraduacaoUpdate(Request $request)
    {
        $this->salvarPaginaCursos($request, 'pos_graduacao');

        return back()->with('status', 'Pagina "Pos-Graduacao" atualizada com sucesso.');
    }

    protected function salvarPaginaCursos(Request $request, string $key): void
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'texto_intro' => ['nullable', 'string', 'max:500'],
            'mostrar_menu' => ['nullable', 'boolean'],
            'cursos' => ['array'],
            'cursos.*.nome' => ['nullable', 'string', 'max:150'],
            'cursos.*.link' => ['nullable', 'string', 'max:500'],
        ]);

        $cursos = array_values(array_filter($data['cursos'] ?? [], fn ($c) => trim((string) ($c['nome'] ?? '')) !== ''));

        ContentStore::save($key, [
            'titulo' => $data['titulo'],
            'texto_intro' => $data['texto_intro'] ?? '',
            'cursos' => $cursos,
            'mostrar_menu' => $request->boolean('mostrar_menu'),
        ]);
    }

    // ---------------------------------------------------------------
    // Equipe
    // ---------------------------------------------------------------

    public function equipeEdit()
    {
        $content = ContentStore::get('equipe', ContentDefaults::equipe());

        return view('admin.sections.equipe', compact('content'));
    }

    public function equipeUpdate(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'introducao' => ['nullable', 'string', 'max:500'],
            'membros' => ['array'],
            'membros.*.nome' => ['nullable', 'string', 'max:100'],
            'membros.*.cargo' => ['nullable', 'string', 'max:100'],
            'membros.*.foto_arquivo' => ['nullable', 'image', 'max:2048'],
        ]);

        $atual = ContentStore::get('equipe', ContentDefaults::equipe());
        $membrosAtuais = $atual['membros'] ?? [];

        $membros = [];
        foreach ($data['membros'] ?? [] as $idx => $membro) {
            $nome = trim((string) ($membro['nome'] ?? ''));
            $cargo = trim((string) ($membro['cargo'] ?? ''));
            $fotoAtual = $membrosAtuais[$idx]['foto'] ?? '';
            $foto = ImageUploader::store($request->file("membros.$idx.foto_arquivo"), $fotoAtual);

            if ($nome === '' && $cargo === '' && $foto === '') {
                continue;
            }

            $membros[] = ['nome' => $nome, 'cargo' => $cargo, 'foto' => $foto];
        }

        ContentStore::save('equipe', [
            'titulo' => $data['titulo'],
            'introducao' => $data['introducao'] ?? '',
            'membros' => $membros,
        ]);

        return back()->with('status', 'Equipe atualizada com sucesso.');
    }

    // ---------------------------------------------------------------
    // Contato
    // ---------------------------------------------------------------

    public function contatoEdit()
    {
        $content = ContentStore::get('contato', ContentDefaults::contato());

        return view('admin.sections.contato', compact('content'));
    }

    public function contatoUpdate(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'texto_intro' => ['nullable', 'string', 'max:500'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'telefone_1' => ['nullable', 'string', 'max:40'],
            'telefone_2' => ['nullable', 'string', 'max:40'],
            'email_1' => ['nullable', 'email', 'max:150'],
            'email_2' => ['nullable', 'email', 'max:150'],
            'mapa_embed_url' => ['nullable', 'string', 'max:1000'],
        ]);

        ContentStore::save('contato', $data);

        return back()->with('status', 'Pagina de contato atualizada com sucesso.');
    }

    /**
     * Remove linhas de listas repetiveis (destaques/itens) totalmente vazias,
     * mantendo apenas as que tem pelo menos um campo preenchido.
     */
    protected function removerLinhasVazias(array $linhas): array
    {
        return array_values(array_filter($linhas, function ($linha) {
            return trim((string) ($linha['titulo'] ?? '')) !== ''
                || trim((string) ($linha['texto'] ?? '')) !== '';
        }));
    }
}
