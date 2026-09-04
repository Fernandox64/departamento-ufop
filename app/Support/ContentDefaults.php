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
            'logo' => 'assets/images/ufop-selo-2.png',
            'logo_transparente' => 'assets/images/UFOP-Main-Menu.png',
            'facebook' => '',
            'instagram' => '',
            'twitter' => '',
            'linkedin' => '',
            'youtube' => '',
        ];
    }

    public static function tema(): array
    {
        return [
            'paleta' => 'decom-temp',
            'menu_transparente' => false,
        ];
    }

    public static function menuPrincipal(): array
    {
        return [
            'inicio' => true,
            'departamento' => true,
            'graduacao' => true,
            'pos_graduacao' => true,
            'servicos' => true,
            'noticias' => true,
            'eventos' => false,
            'pessoal' => true,
            'contato' => true,
        ];
    }

    public static function paletasTema(): array
    {
        return [
            'ufop-oficial' => [
                'nome' => 'UFOP Oficial',
                'descricao' => 'Esquema oficial solicitado com cinza de apoio e vermelho institucional.',
                'cores' => ['#FFFFFF', '#999999', '#9B1B36', '#991B33', '#F4F4F4', '#2B2B2B'],
            ],
            'ufop-institucional-classica' => [
                'nome' => 'UFOP Institucional Classica',
                'descricao' => 'Paleta institucional equilibrada para comunicacao formal.',
                'cores' => ['#FFFFFF', '#737373', '#C8102E', '#9D0B16', '#F4F5F7', '#20252B'],
            ],
            'azul-institucional' => [
                'nome' => 'Azul Institucional',
                'descricao' => 'Paleta padrao com tons de azul e destaque amarelo.',
                'cores' => ['#FFD84D', '#4BBFDB', '#5270EB', '#151C9C', '#F2F6FA', '#11195A'],
            ],
            'decom-temp' => [
                'nome' => 'DECOM Temp',
                'descricao' => 'Inspirada no site temp.decom.ufop.br: preto, chili, azul profundo e cinza frio.',
                'cores' => ['#FFFFFF', '#9EABAE', '#AB0520', '#8B0015', '#E2E9EB', '#001C48'],
            ],
            'ufop-classica' => [
                'nome' => 'UFOP Classica',
                'descricao' => 'Paleta vinho e cinza inspirada no portal e na logomarca institucional da UFOP.',
                'cores' => ['#B88E55', '#AEB4BC', '#9A1B45', '#5B0F2B', '#F5F5F5', '#252B31'],
            ],
            'verde-campus' => [
                'nome' => 'Verde Campus',
                'descricao' => 'Tons de verde para visual natural e academico.',
                'cores' => ['#A8D46A', '#65C9AE', '#2F9648', '#1F6D31', '#F0F8F4', '#123E22'],
            ],
            'oceano-profundo' => [
                'nome' => 'Oceano Profundo',
                'descricao' => 'Azul petroleo com contraste moderno.',
                'cores' => ['#F2BF52', '#4AC2C0', '#1D9ED6', '#0F4664', '#EEF6FA', '#0B2238'],
            ],
            'por-do-sol' => [
                'nome' => 'Por do Sol',
                'descricao' => 'Mistura de laranja, coral e azul noturno.',
                'cores' => ['#FFC44D', '#FF8F7D', '#E3684B', '#244D5A', '#FFF6EF', '#3B2925'],
            ],
            'grafite' => [
                'nome' => 'Grafite',
                'descricao' => 'Neutra e sofisticada, com destaque dourado.',
                'cores' => ['#D2AA28', '#9AA2AD', '#465363', '#1F2A38', '#F5F6F8', '#0F1723'],
            ],
            'vinho-academico' => [
                'nome' => 'Vinho Academico',
                'descricao' => 'Tons de vinho com apoio quente.',
                'cores' => ['#F0C06B', '#D99AAD', '#A02D6B', '#651B3E', '#FBF4F7', '#43152D'],
            ],
            'lavanda-tech' => [
                'nome' => 'Lavanda Tech',
                'descricao' => 'Visual leve com violeta e azul claro.',
                'cores' => ['#FFD54D', '#9AAAF3', '#7439E6', '#383083', '#F2F0FA', '#241B51'],
            ],
            'turquesa-energia' => [
                'nome' => 'Turquesa Energia',
                'descricao' => 'Paleta vibrante para portais dinamicos.',
                'cores' => ['#FFDE4D', '#32C9B7', '#1DB0A0', '#177D75', '#EAF8F6', '#144E4A'],
            ],
            'terra-cobre' => [
                'nome' => 'Terra Cobre',
                'descricao' => 'Paleta terrosa com boa legibilidade.',
                'cores' => ['#EAC063', '#D99A5E', '#BF681E', '#74391F', '#F8F4EE', '#422924'],
            ],
            'vermelho-grafite' => [
                'nome' => 'Vermelho Grafite',
                'descricao' => 'Variacao em tons de vermelho, cinza e preto para visual forte e moderno.',
                'cores' => ['#C8A462', '#A7ADB4', '#C51A1A', '#111111', '#EFF0F2', '#202020'],
            ],
            'petroleo-verde' => [
                'nome' => 'Petroleo Verde',
                'descricao' => 'Inspirada na paleta azul e verde da referencia enviada.',
                'cores' => ['#8BC657', '#1E9A95', '#146276', '#10075A', '#EEF6F6', '#0B2D38'],
            ],
            'areia-terracota' => [
                'nome' => 'Areia Terracota',
                'descricao' => 'Inspirada na paleta terrosa clara da referencia enviada.',
                'cores' => ['#DDD28F', '#D0C873', '#D3AA5A', '#7A5E24', '#F7F1E3', '#3D2D16'],
            ],
            'oliva-terra' => [
                'nome' => 'Oliva Terra',
                'descricao' => 'Inspirada na paleta oliva, cobre e grafite da referencia enviada.',
                'cores' => ['#B28A4A', '#6E6B3B', '#A4492E', '#3E573F', '#EFEDE6', '#292823'],
            ],
            'vermelho-intensificado' => [
                'nome' => 'Vermelho Intensificado',
                'descricao' => 'Variacao moderna com alto contraste para destaques visuais.',
                'cores' => ['#F7F7F7', '#8E8E8E', '#E31822', '#B30D18', '#F1F2F3', '#171717'],
            ],
            'vermelho-premium' => [
                'nome' => 'Vermelho Premium',
                'descricao' => 'Visual sofisticado para departamento com pesquisa e tecnologia.',
                'cores' => ['#E5E5E5', '#B50F1B', '#D71920', '#183152', '#F8F8F8', '#343434'],
            ],
            'canva-divertido-profissional' => [
                'nome' => 'Canva Divertido Profissional',
                'descricao' => 'Inspirada em combinacoes com azul forte, amarelo quente e acentos vibrantes.',
                'cores' => ['#F7C948', '#91A7B3', '#1261A0', '#F26A4F', '#F4FAFF', '#12324A'],
            ],
            'canva-historia-arte' => [
                'nome' => 'Canva Historia da Arte',
                'descricao' => 'Inspirada em amarelos quentes, azuis ricos e verdes puros.',
                'cores' => ['#F2C14E', '#88A096', '#1D5C63', '#2E7D32', '#FFF8E7', '#1F3140'],
            ],
            'canva-moderno-puro' => [
                'nome' => 'Canva Moderno Puro',
                'descricao' => 'Inspirada em azul vivo, laranja intenso, branco e cinzas limpos.',
                'cores' => ['#FFB703', '#B8C4CC', '#0077B6', '#FB8500', '#F7FAFC', '#123047'],
            ],
            'canva-neon-contraste' => [
                'nome' => 'Canva Neon Contraste',
                'descricao' => 'Inspirada em preto com roxo, azul e rosa neon.',
                'cores' => ['#F72585', '#8E9AAF', '#7209B7', '#00B4D8', '#F8F9FA', '#111111'],
            ],
            'canva-turquesa-moderno' => [
                'nome' => 'Canva Turquesa Moderno',
                'descricao' => 'Inspirada em turquesa com laranja, cinza e menta.',
                'cores' => ['#F4A261', '#A8DADC', '#2A9D8F', '#E76F51', '#F1FAEE', '#264653'],
            ],
            'canva-azul-dourado' => [
                'nome' => 'Canva Azul Dourado',
                'descricao' => 'Inspirada em azuis profundos com detalhe dourado elegante.',
                'cores' => ['#D4AF37', '#A8B2C1', '#12355B', '#E0A800', '#F6F7F9', '#081A2B'],
            ],
            'canva-preto-vibrante' => [
                'nome' => 'Canva Preto Vibrante',
                'descricao' => 'Inspirada em preto e branco com destaques fortes e modernos.',
                'cores' => ['#FFD166', '#BFC7D5', '#EF476F', '#06D6A0', '#FFFFFF', '#101014'],
            ],
            'canva-azul-turquesa' => [
                'nome' => 'Canva Azul Turquesa',
                'descricao' => 'Inspirada em degradacoes de azul e turquesa com frescor digital.',
                'cores' => ['#80ED99', '#B8D8D8', '#118AB2', '#06D6A0', '#EEF9F9', '#073B4C'],
            ],
            'canva-azul-bronze' => [
                'nome' => 'Canva Azul Bronze',
                'descricao' => 'Inspirada em azul-marinho, bronze e vermelho vivo.',
                'cores' => ['#C9974D', '#AAB3BF', '#0B2545', '#D1495B', '#F7F5F0', '#071629'],
            ],
            'canva-roxo-limao' => [
                'nome' => 'Canva Roxo Limao',
                'descricao' => 'Inspirada em roxo marcante com verde limao e branco.',
                'cores' => ['#C8FF00', '#D7DEE8', '#5A189A', '#80B918', '#FBFFF2', '#240046'],
            ],
            'canva-tropical' => [
                'nome' => 'Canva Tropical',
                'descricao' => 'Inspirada em turquesa, roxo, amarelo e toques alaranjados.',
                'cores' => ['#FFD166', '#90BE6D', '#118AB2', '#EF476F', '#FFFDF2', '#073B4C'],
            ],
            'canva-cinza-cereja' => [
                'nome' => 'Canva Cinza Cereja',
                'descricao' => 'Inspirada em cinza, grafite, azul-marinho e cereja.',
                'cores' => ['#C1121F', '#B7BDC6', '#2B2D42', '#780000', '#F5F6F8', '#161A1D'],
            ],
            'canva-vintage-dourado' => [
                'nome' => 'Canva Vintage Dourado',
                'descricao' => 'Inspirada em dourado, verde, marrom e branco vintage.',
                'cores' => ['#D6A84F', '#B7A99A', '#386641', '#8B5E34', '#FFF8E8', '#3A2E25'],
            ],
            'canva-salmao-menta' => [
                'nome' => 'Canva Salmao Menta',
                'descricao' => 'Inspirada em grafite, salmao, menta e tons claros.',
                'cores' => ['#F4A261', '#B8DED6', '#2F6F73', '#E76F51', '#F6EFE6', '#2B2D2F'],
            ],
            'canva-neon-ousado' => [
                'nome' => 'Canva Neon Ousado',
                'descricao' => 'Inspirada em verde vibrante, roxo, azul e branco.',
                'cores' => ['#CCFF00', '#B8B8FF', '#3A0CA3', '#00BBF9', '#FFFFFF', '#111827'],
            ],
            'canva-pop-art' => [
                'nome' => 'Canva Arte Pop',
                'descricao' => 'Inspirada em rosa forte, amarelo e azul de alto impacto.',
                'cores' => ['#FFDE59', '#B8C0FF', '#FF2E88', '#2563EB', '#FFFFFF', '#111827'],
            ],
        ];
    }

    public static function paletaTema(string $key): array
    {
        $paletas = static::paletasTema();

        return $paletas[$key] ?? $paletas[static::tema()['paleta']];
    }

    public static function rodape(): array
    {
        return [
            'logo' => 'assets/images/ufop-selo-2.png',
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
            'sobre_imagem' => 'assets/images/about.png',
            'mostrar_sobre_home' => true,
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

    /**
     * Imagem grande que abre a pagina inicial. Fica em secao propria do painel
     * (nao sai das noticias), entao a secretaria troca quando quiser.
     */
    public static function destaque(): array
    {
        return [
            'imagem' => 'assets/images/latest-news/1.jpg',
            'legenda' => '',
            'texto' => '',
            'link' => '',
        ];
    }

    public static function pessoal(): array
    {
        return [
            'titulo' => 'Pessoal',
            'introducao' => 'Conheca os docentes e funcionarios que fazem parte do nosso departamento.',
            'membros' => [
                ['nome' => 'Nome do Docente', 'cargo' => 'Cargo ou funcao', 'categoria' => 'docente', 'foto' => 'assets/images/team/1.jpg'],
                ['nome' => 'Nome do Docente', 'cargo' => 'Cargo ou funcao', 'categoria' => 'docente', 'foto' => 'assets/images/team/2.jpg'],
                ['nome' => 'Nome do Funcionario', 'cargo' => 'Cargo ou funcao', 'categoria' => 'funcionario', 'foto' => 'assets/images/team/3.jpg'],
            ],
            'mostrar_menu' => true,
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
