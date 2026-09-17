<?php

namespace App\Support;

class AdminNav
{
    /**
     * Secoes do painel admin: usadas tanto nos cards do dashboard quanto no
     * menu lateral, para manter titulo/icone/rota num unico lugar.
     */
    public static function secoes(): array
    {
        return [
            ['chave' => 'tutorial', 'titulo' => 'Tutorial: como usar o site', 'titulo_menu' => 'Tutorial', 'rota' => 'admin.tutorial', 'padrao' => 'admin.tutorial', 'acao' => 'Abrir', 'icone' => 'fa-solid fa-book-open'],
            ['chave' => 'configuracoes', 'titulo' => 'Configuracoes gerais', 'rota' => 'admin.configuracoes.edit', 'padrao' => 'admin.configuracoes.*', 'apenas_administrador' => true, 'icone' => 'fa-solid fa-gear'],
            ['chave' => 'logos', 'titulo' => 'Logos do site', 'rota' => 'admin.logos.edit', 'padrao' => 'admin.logos.*', 'apenas_administrador' => true, 'icone' => 'fa-solid fa-image'],
            ['chave' => 'tema', 'titulo' => 'Tema e Cores', 'rota' => 'admin.tema.edit', 'padrao' => 'admin.tema.*', 'icone' => 'fa-solid fa-palette', 'divisor_antes' => true],
            ['chave' => 'menu', 'titulo' => 'Menu principal', 'rota' => 'admin.menu.edit', 'padrao' => 'admin.menu.*', 'icone' => 'fa-solid fa-bars'],
            ['chave' => 'rodape', 'titulo' => 'Rodape do site', 'rota' => 'admin.rodape.edit', 'padrao' => 'admin.rodape.*', 'icone' => 'fa-solid fa-grip-lines'],
            ['chave' => 'home', 'titulo' => 'Pagina inicial', 'rota' => 'admin.home.edit', 'padrao' => 'admin.home.*', 'icone' => 'fa-solid fa-house'],
            ['chave' => 'destaque', 'titulo' => 'Imagens de destaque', 'rota' => 'admin.destaque.edit', 'padrao' => 'admin.destaque.*', 'icone' => 'fa-solid fa-star'],
            ['chave' => 'carrossel', 'titulo' => 'Carrossel de imagens', 'rota' => 'admin.carrossel.edit', 'padrao' => 'admin.carrossel.*', 'icone' => 'fa-solid fa-images'],
            ['chave' => 'noticias', 'titulo' => 'Noticias e Editais', 'rota' => 'admin.noticias.index', 'padrao' => 'admin.noticias.*', 'icone' => 'fa-solid fa-newspaper'],
            ['chave' => 'eventos', 'titulo' => 'Eventos', 'rota' => 'admin.eventos.index', 'padrao' => 'admin.eventos.*', 'icone' => 'fa-solid fa-calendar-days'],
            ['chave' => 'sobre', 'titulo' => 'Sobre o departamento', 'rota' => 'admin.sobre.edit', 'padrao' => 'admin.sobre.*', 'icone' => 'fa-solid fa-building-columns'],
            ['chave' => 'servicos', 'titulo' => 'Servicos', 'rota' => 'admin.servicos.edit', 'padrao' => 'admin.servicos.*', 'icone' => 'fa-solid fa-handshake'],
            ['chave' => 'graduacao', 'titulo' => 'Graduacao', 'rota' => 'admin.graduacao.edit', 'padrao' => 'admin.graduacao.*', 'icone' => 'fa-solid fa-graduation-cap'],
            ['chave' => 'pos_graduacao', 'titulo' => 'Pos-Graduacao', 'rota' => 'admin.pos-graduacao.edit', 'padrao' => 'admin.pos-graduacao.*', 'icone' => 'fa-solid fa-user-graduate'],
            ['chave' => 'pessoal', 'titulo' => 'Pessoal', 'rota' => 'admin.pessoal.edit', 'padrao' => 'admin.pessoal.*', 'icone' => 'fa-solid fa-users'],
            ['chave' => 'contato', 'titulo' => 'Contato', 'rota' => 'admin.contato.edit', 'padrao' => 'admin.contato.*', 'icone' => 'fa-solid fa-address-book'],
            ['chave' => 'backup', 'titulo' => 'Backup do site', 'rota' => 'admin.backup.index', 'padrao' => 'admin.backup.*', 'apenas_administrador' => true, 'icone' => 'fa-solid fa-box-archive', 'divisor_antes' => true],
            ['chave' => 'membros', 'titulo' => 'Membros da equipe', 'rota' => 'admin.membros.index', 'padrao' => 'admin.membros.*', 'apenas_administrador' => true, 'icone' => 'fa-solid fa-user-shield'],
        ];
    }
}
