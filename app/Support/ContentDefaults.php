<?php

namespace App\Support;

class ContentDefaults
{
    public static function membros(): array
    {
        return ['items' => []];
    }

    public static function configuracoes(): array
    {
        return [
            'nome_site' => 'Departamento Modelo',
            'sigla' => 'DEP',
            'logo' => 'assets/images/ufop-selo.png',
            'facebook' => '',
            'instagram' => '',
            'twitter' => '',
            'linkedin' => '',
            'youtube' => '',
        ];
    }

    public static function rodape(): array
    {
        return [
            'logo' => 'assets/images/ufop-selo.png',
            'texto' => 'Informacoes, servicos e noticias do departamento em um so lugar.',
            'copyright' => 'Todos os direitos reservados.',
            'endereco' => 'Endereco do departamento, Cidade - UF',
            'telefone' => '(00) 0000-0000',
            'email' => 'contato@departamento.br',
        ];
    }

    public static function home(): array
    {
        return [
            'hero_titulo' => 'Bem-vindo ao Departamento Modelo',
            'hero_subtitulo' => 'Servindo a comunidade com excelencia, transparencia e compromisso.',
            'destaques' => [
                ['icone' => 'fa-solid fa-building-columns', 'titulo' => 'Atendimento', 'texto' => 'Horarios e canais de atendimento ao publico.'],
                ['icone' => 'fa-solid fa-file-lines', 'titulo' => 'Servicos', 'texto' => 'Principais servicos oferecidos pelo departamento.'],
                ['icone' => 'fa-solid fa-users', 'titulo' => 'Equipe', 'texto' => 'Conheca os profissionais responsaveis por cada area.'],
            ],
            'sobre_titulo' => 'Quem somos',
            'sobre_texto' => 'O Departamento Modelo atua para oferecer servicos de qualidade a comunidade, com uma equipe dedicada e comprometida com a transparencia.',
        ];
    }

    public static function noticias(): array
    {
        return [
            'items' => [
                [
                    'id' => 'exemplo-noticia',
                    'tipo' => 'noticia',
                    'titulo' => 'Departamento realiza evento de boas-vindas',
                    'resumo' => 'Confira como foi o evento de recepcao aos novos alunos e servidores.',
                    'conteudo' => "Este e um exemplo de noticia. Edite ou exclua pelo painel admin em Noticias e Editais.\n\nSubstitua este texto pelo conteudo real da noticia.",
                    'imagem' => 'assets/images/hero-blog/1.jpg',
                    'anexo' => '',
                    'data_publicacao' => '2026-01-15',
                ],
                [
                    'id' => 'exemplo-edital',
                    'tipo' => 'edital',
                    'titulo' => 'Edital de selecao - exemplo',
                    'resumo' => 'Edital de exemplo para processo seletivo. Substitua pelo edital real do departamento.',
                    'conteudo' => "Este e um exemplo de edital. Anexe o PDF oficial e edite este texto pelo painel admin.",
                    'imagem' => '',
                    'anexo' => '',
                    'data_publicacao' => '2026-01-10',
                ],
            ],
        ];
    }

    public static function carrossel(): array
    {
        return [
            'slides' => [
                ['imagem' => 'assets/images/hero-blog/1.jpg', 'legenda' => 'Adicione fotos do departamento pelo painel admin'],
                ['imagem' => 'assets/images/hero-blog/2.jpg', 'legenda' => ''],
                ['imagem' => 'assets/images/hero-blog/3.jpg', 'legenda' => ''],
            ],
        ];
    }

    public static function sobre(): array
    {
        return [
            'titulo' => 'Sobre o Departamento',
            'texto_intro' => 'Conheca um pouco mais sobre a historia, a missao e os valores do nosso departamento.',
            'texto_corpo' => "O Departamento Modelo foi criado para atender as demandas da comunidade com agilidade e transparencia.\n\nNossa equipe trabalha diariamente para garantir um atendimento de qualidade, seguindo os principios de etica e responsabilidade publica.",
            'imagem' => 'assets/images/about.png',
            'destaques' => ['Atendimento humanizado', 'Transparencia nas informacoes', 'Compromisso com a comunidade'],
        ];
    }

    public static function servicos(): array
    {
        return [
            'titulo' => 'Nossos Servicos',
            'introducao' => 'Confira abaixo os principais servicos oferecidos pelo departamento.',
            'itens' => [
                ['icone' => 'fa-solid fa-file-lines', 'titulo' => 'Servico 1', 'texto' => 'Descricao breve do servico oferecido.'],
                ['icone' => 'fa-solid fa-headset', 'titulo' => 'Servico 2', 'texto' => 'Descricao breve do servico oferecido.'],
                ['icone' => 'fa-solid fa-clipboard-check', 'titulo' => 'Servico 3', 'texto' => 'Descricao breve do servico oferecido.'],
            ],
        ];
    }

    public static function equipe(): array
    {
        return [
            'titulo' => 'Nossa Equipe',
            'introducao' => 'Conheca os profissionais que fazem parte do nosso departamento.',
            'membros' => [
                ['nome' => 'Nome do Servidor', 'cargo' => 'Cargo ou funcao', 'foto' => 'assets/images/team/1.jpg'],
                ['nome' => 'Nome do Servidor', 'cargo' => 'Cargo ou funcao', 'foto' => 'assets/images/team/2.jpg'],
                ['nome' => 'Nome do Servidor', 'cargo' => 'Cargo ou funcao', 'foto' => 'assets/images/team/3.jpg'],
            ],
        ];
    }

    public static function graduacao(): array
    {
        return [
            'titulo' => 'Graduacao',
            'texto_intro' => 'Conheca os cursos de graduacao oferecidos pelo departamento.',
            'cursos' => [
                ['nome' => 'Nome do curso (Bacharelado)', 'link' => ''],
                ['nome' => 'Nome do curso (Licenciatura)', 'link' => ''],
            ],
            'mostrar_menu' => true,
        ];
    }

    public static function posGraduacao(): array
    {
        return [
            'titulo' => 'Pos-Graduacao',
            'texto_intro' => 'Conheca os programas de pos-graduacao oferecidos pelo departamento.',
            'cursos' => [
                ['nome' => 'Nome do programa (Mestrado)', 'link' => ''],
            ],
            'mostrar_menu' => true,
        ];
    }

    public static function eventos(): array
    {
        return [
            'items' => [
                [
                    'id' => 'exemplo-evento',
                    'titulo' => 'Evento de exemplo',
                    'data_evento' => '2026-12-01',
                    'local' => 'Auditorio do departamento',
                    'descricao' => 'Substitua por um evento real ou exclua pelo painel admin.',
                    'link' => '',
                ],
            ],
            'mostrar_menu' => false,
        ];
    }

public static function contato(): array
    {
        return [
            'titulo' => 'Fale Conosco',
            'texto_intro' => 'Entre em contato com o departamento pelos canais abaixo ou envie uma mensagem.',
            'endereco' => 'Endereco do departamento, Cidade - UF',
            'telefone_1' => '(00) 0000-0000',
            'telefone_2' => '',
            'email_1' => 'contato@departamento.br',
            'email_2' => '',
            'mapa_embed_url' => '',
        ];
    }
}
