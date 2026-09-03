<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ContentDefaults;
use App\Support\ContentStore;
use App\Support\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContentController extends Controller
{
    public function dashboard()
    {
        $administrador = session('admin_nivel') === 'administrador';

        $secoes = [
            ['chave' => 'configuracoes', 'titulo' => 'Configuracoes gerais', 'rota' => 'admin.configuracoes.edit', 'apenas_administrador' => true],
            ['chave' => 'logos', 'titulo' => 'Logos do site', 'rota' => 'admin.logos.edit', 'apenas_administrador' => true],
            ['chave' => 'tema', 'titulo' => 'Tema e Cores', 'rota' => 'admin.tema.edit'],
            ['chave' => 'rodape', 'titulo' => 'Rodape do site', 'rota' => 'admin.rodape.edit'],
            ['chave' => 'home', 'titulo' => 'Pagina inicial', 'rota' => 'admin.home.edit'],
            ['chave' => 'destaque', 'titulo' => 'Imagens de destaque', 'rota' => 'admin.destaque.edit'],
            ['chave' => 'carrossel', 'titulo' => 'Carrossel de imagens', 'rota' => 'admin.carrossel.edit'],
            ['chave' => 'noticias', 'titulo' => 'Noticias e Editais', 'rota' => 'admin.noticias.index'],
            ['chave' => 'eventos', 'titulo' => 'Eventos', 'rota' => 'admin.eventos.index'],
            ['chave' => 'sobre', 'titulo' => 'Sobre o departamento', 'rota' => 'admin.sobre.edit'],
            ['chave' => 'servicos', 'titulo' => 'Servicos', 'rota' => 'admin.servicos.edit'],
            ['chave' => 'graduacao', 'titulo' => 'Graduacao', 'rota' => 'admin.graduacao.edit'],
            ['chave' => 'pos_graduacao', 'titulo' => 'Pos-Graduacao', 'rota' => 'admin.pos-graduacao.edit'],
            ['chave' => 'pessoal', 'titulo' => 'Pessoal', 'rota' => 'admin.pessoal.edit'],
            ['chave' => 'contato', 'titulo' => 'Contato', 'rota' => 'admin.contato.edit'],
            ['chave' => 'backup', 'titulo' => 'Backup do site', 'rota' => 'admin.backup.index', 'apenas_administrador' => true],
            ['chave' => 'membros', 'titulo' => 'Membros da equipe', 'rota' => 'admin.membros.index', 'apenas_administrador' => true],
        ];

        $secoes = array_values(array_filter(
            $secoes,
            fn ($secao) => $administrador || empty($secao['apenas_administrador'])
        ));

        return view('admin.dashboard', compact('secoes'));
    }

    // ---------------------------------------------------------------
    // Tema e cores
    // ---------------------------------------------------------------

    public function temaEdit()
    {
        $content = ContentStore::get('tema', ContentDefaults::tema());
        $paletas = ContentDefaults::paletasTema();

        return view('admin.sections.tema', compact('content', 'paletas'));
    }

    public function temaUpdate(Request $request)
    {
        $data = $request->validate([
            'paleta' => ['required', Rule::in(array_keys(ContentDefaults::paletasTema()))],
            'menu_transparente' => ['nullable', 'boolean'],
        ]);

        ContentStore::save('tema', [
            'paleta' => $data['paleta'],
            'menu_transparente' => $request->boolean('menu_transparente'),
        ]);

        return back()->with('status', 'Tema e cores atualizados com sucesso.');
    }

    // ---------------------------------------------------------------
    // Configuracoes gerais
    // ---------------------------------------------------------------

    public function logosEdit()
    {
        $configuracoes = ContentStore::get('configuracoes', ContentDefaults::configuracoes());
        $rodape = ContentStore::get('rodape', ContentDefaults::rodape());

        return view('admin.sections.logos', compact('configuracoes', 'rodape'));
    }

    public function logosUpdate(Request $request)
    {
        $request->validate([
            'logo_principal_arquivo' => ['nullable', 'image', 'max:2048'],
            'logo_principal_transparente_arquivo' => ['nullable', 'image', 'max:2048'],
            'logo_rodape_arquivo' => ['nullable', 'image', 'max:2048'],
        ], [
            'logo_principal_arquivo.max' => 'A logo do menu principal deve ter no maximo 2 MB.',
            'logo_principal_transparente_arquivo.max' => 'A logo do menu principal transparente deve ter no maximo 2 MB.',
            'logo_rodape_arquivo.max' => 'A logo do footer deve ter no maximo 2 MB.',
            'logo_principal_arquivo.image' => 'A logo do menu principal deve ser uma imagem valida.',
            'logo_principal_transparente_arquivo.image' => 'A logo do menu principal transparente deve ser uma imagem valida.',
            'logo_rodape_arquivo.image' => 'A logo do footer deve ser uma imagem valida.',
        ]);

        $configuracoes = ContentStore::get('configuracoes', ContentDefaults::configuracoes());
        $rodape = ContentStore::get('rodape', ContentDefaults::rodape());

        $configuracoes['logo'] = ImageUploader::store(
            $request->file('logo_principal_arquivo'),
            $configuracoes['logo']
        );
        $configuracoes['logo_transparente'] = ImageUploader::store(
            $request->file('logo_principal_transparente_arquivo'),
            $configuracoes['logo_transparente'] ?? $configuracoes['logo']
        );
        $rodape['logo'] = ImageUploader::store(
            $request->file('logo_rodape_arquivo'),
            $rodape['logo']
        );

        ContentStore::save('configuracoes', $configuracoes);
        ContentStore::save('rodape', $rodape);

        return back()->with('status', 'Logos atualizadas com sucesso.');
    }

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
        ]);

        $atual = ContentStore::get('configuracoes', ContentDefaults::configuracoes());

        $data['logo'] = $atual['logo'];
        $data['logo_transparente'] = $atual['logo_transparente'] ?? $atual['logo'];

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
        ]);

        $atual = ContentStore::get('rodape', ContentDefaults::rodape());

        $data['logo'] = $atual['logo'];

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
    // Imagem de destaque da pagina inicial
    // ---------------------------------------------------------------

    public function destaqueEdit()
    {
        $content = ContentStore::get('destaque', ContentDefaults::destaque());

        return view('admin.sections.destaque', compact('content'));
    }

    public function destaqueUpdate(Request $request)
    {
        $data = $request->validate([
            'slides' => ['array'],
            'slides.*.legenda' => ['nullable', 'string', 'max:150'],
            'slides.*.texto' => ['nullable', 'string', 'max:500'],
            'slides.*.link' => ['nullable', 'string', 'max:500'],
            'slides.*.imagem_arquivo' => ['nullable', 'image', 'max:4096'],
        ]);

        $atual = ContentStore::get('destaque', ContentDefaults::destaque());
        $slidesAtuais = $this->normalizarSlidesDestaque($atual);

        $slides = [];
        foreach ($data['slides'] ?? [] as $idx => $slide) {
            $imagemAtual = $slidesAtuais[$idx]['imagem'] ?? '';
            $imagem = ImageUploader::store($request->file("slides.$idx.imagem_arquivo"), $imagemAtual);

            if ($imagem === '') {
                continue;
            }

            $slides[] = [
                'imagem' => $imagem,
                'legenda' => trim((string) ($slide['legenda'] ?? '')),
                'texto' => trim((string) ($slide['texto'] ?? '')),
                'link' => trim((string) ($slide['link'] ?? '')),
            ];
        }

        ContentStore::save('destaque', ['slides' => $slides]);

        return back()->with('status', 'Imagens de destaque atualizadas com sucesso.');
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
    // Pessoal (Docentes / Funcionarios)
    // ---------------------------------------------------------------

    public function pessoalEdit()
    {
        $content = ContentStore::get('pessoal', ContentDefaults::pessoal());

        return view('admin.sections.pessoal', compact('content'));
    }

    public function pessoalUpdate(Request $request)
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'introducao' => ['nullable', 'string', 'max:500'],
            'mostrar_menu' => ['nullable', 'boolean'],
            'membros' => ['array'],
            'membros.*.nome' => ['nullable', 'string', 'max:100'],
            'membros.*.cargo' => ['nullable', 'string', 'max:100'],
            'membros.*.categoria' => ['nullable', 'in:docente,funcionario'],
            'membros.*.foto_arquivo' => ['nullable', 'image', 'max:2048'],
        ]);

        $atual = ContentStore::get('pessoal', ContentDefaults::pessoal());
        $membrosAtuais = $atual['membros'] ?? [];

        $membros = [];
        foreach ($data['membros'] ?? [] as $idx => $membro) {
            $nome = trim((string) ($membro['nome'] ?? ''));
            $cargo = trim((string) ($membro['cargo'] ?? ''));
            $categoria = $membro['categoria'] ?? 'docente';
            $fotoAtual = $membrosAtuais[$idx]['foto'] ?? '';
            $foto = ImageUploader::store($request->file("membros.$idx.foto_arquivo"), $fotoAtual);

            if ($nome === '' && $cargo === '' && $foto === '') {
                continue;
            }

            $membros[] = ['nome' => $nome, 'cargo' => $cargo, 'categoria' => $categoria, 'foto' => $foto];
        }

        ContentStore::save('pessoal', [
            'titulo' => $data['titulo'],
            'introducao' => $data['introducao'] ?? '',
            'membros' => $membros,
            'mostrar_menu' => $request->boolean('mostrar_menu'),
        ]);

        return back()->with('status', 'Pessoal atualizado com sucesso.');
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

    protected function normalizarSlidesDestaque(array $content): array
    {
        if (! empty($content['slides']) && is_array($content['slides'])) {
            return array_values(array_filter($content['slides'], fn ($slide) => ! empty($slide['imagem'])));
        }

        if (! empty($content['imagem'])) {
            return [[
                'imagem' => $content['imagem'],
                'legenda' => $content['legenda'] ?? '',
                'texto' => $content['texto'] ?? '',
                'link' => $content['link'] ?? '',
            ]];
        }

        return [];
    }
}
