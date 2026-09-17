@extends('admin.layout')

@section('content')
    <p class="tutorial-eyebrow">Guia para quem publica notícias, editais e cuida do conteúdo</p>
    <h1 class="h4 mb-2">Tutorial: como usar o site</h1>
    <p class="text-muted">
        Passo a passo de tudo que dá para editar pelo painel — sem precisar entender nada de
        programação. Toda alteração aparece no site assim que você salva, na mesma hora.
    </p>

    <div class="d-flex flex-wrap gap-2 my-3">
        <span class="badge text-bg-light border">Sem instalar nada</span>
        <span class="badge text-bg-light border">Alterações aparecem na hora</span>
        <span class="badge text-bg-light border">Sem banco de dados</span>
    </div>

    <div class="tutorial-toc">
        <div class="tutorial-toc-group">
            <h3>Primeiros passos</h3>
            <a href="#visao-geral">Visão geral</a>
            <a href="#entrar">Como entrar no painel</a>
            <a href="#regras-gerais">Regras que valem sempre</a>
            <a href="#permissoes">Sua conta e permissões</a>
        </div>
        <div class="tutorial-toc-group">
            <h3>Identidade visual</h3>
            <a href="#tema-cores">Tema e cores</a>
            <a href="#logos">Logos</a>
            <a href="#menu-principal">Menu principal</a>
            <a href="#rodape">Rodapé</a>
        </div>
        <div class="tutorial-toc-group">
            <h3>Página inicial</h3>
            <a href="#home">Boas-vindas e destaques</a>
            <a href="#carrossel">Carrossel de imagens</a>
            <a href="#destaque">Imagens de destaque</a>
        </div>
        <div class="tutorial-toc-group">
            <h3>Conteúdo do site</h3>
            <a href="#noticias-editais">Notícias e Editais</a>
            <a href="#eventos">Eventos</a>
            <a href="#sobre">Sobre o Departamento</a>
            <a href="#servicos">Serviços</a>
            <a href="#cursos">Graduação e Pós-Graduação</a>
            <a href="#pessoal">Pessoal</a>
            <a href="#contato">Contato</a>
        </div>
        <div class="tutorial-toc-group">
            <h3>Administração</h3>
            <a href="#membros">Membros da equipe</a>
            <a href="#backup">Backup e restauração</a>
            <a href="#adaptar">Usar em outro departamento/lab</a>
        </div>
        <div class="tutorial-toc-group">
            <h3>Ajuda</h3>
            <a href="#faq">Perguntas frequentes</a>
            <a href="#ajuda">Precisa de ajuda?</a>
        </div>
    </div>

    <div class="tutorial-section" id="visao-geral">
        <h2>Visão geral</h2>
        <p>
            Este site foi construído a partir de um <strong>modelo pronto para departamentos e
            laboratórios</strong>: a estrutura de páginas (Início, O Departamento, Notícias,
            Eventos, Graduação, Pós-Graduação, Pessoal, Contato) já vem montada, e tudo o que
            aparece nela — textos, fotos, notícias, editais, cores — é editado por este painel,
            sem tocar em código.
        </p>
        <p>
            Cada seção do site (Notícias, Página inicial, Rodapé, Equipe...) tem sua própria tela
            de edição, listada no menu à esquerda. Você abre a tela, altera o que for preciso e
            salva — o site público é atualizado imediatamente, sem etapa de "publicar" separada.
        </p>
        <div class="tutorial-callout tip">
            <span class="label">Não existe "quebrar o site"</span>
            <p class="mb-0">Como não há programação envolvida, preencher um formulário errado no
            máximo deixa um texto estranho no ar — nunca derruba o site. Fique à vontade para
            explorar as telas.</p>
        </div>
    </div>

    <div class="tutorial-section" id="entrar">
        <h2>Como entrar no painel</h2>
        <ol class="tutorial-steps">
            <li>Abra o navegador e acesse o endereço do site seguido de
            <code class="tutorial-code">/admin/login</code>.</li>
            <li>Digite o <strong>e-mail</strong> e a <strong>senha</strong> que foram cadastrados
            para você.</li>
            <li>Se for sempre usar o mesmo computador, deixe marcada a opção <strong>"Lembrar por
            30 dias"</strong> (já vem marcada) — assim você não precisa digitar a senha de novo
            tão cedo.</li>
            <li>Clique em <strong>Entrar</strong>.</li>
        </ol>
        <p>
            Para sair com segurança — principalmente em computador compartilhado — clique em
            <strong>Sair</strong> no canto superior direito.
        </p>
        <div class="tutorial-callout warn">
            <span class="label">Atenção</span>
            <p class="mb-0">Depois de <strong>5 tentativas de senha errada em menos de um
            minuto</strong>, o sistema bloqueia novas tentativas por um tempo, por segurança.
            Esqueceu a senha de verdade? Só quem administra o servidor consegue gerar uma nova —
            não existe "recuperar senha por e-mail" neste sistema.</p>
        </div>
    </div>

    <div class="tutorial-section" id="regras-gerais">
        <h2>Regras que valem para todas as telas</h2>
        <ul>
            <li>Depois de alterar qualquer campo, sempre clique em <strong>Salvar
            alterações</strong> no final da página — sem isso, nada é gravado.</li>
            <li>Assim que você salva, a mudança já aparece no site <strong>na mesma hora</strong>
            — não é preciso "publicar" nem esperar.</li>
            <li>Se algum campo obrigatório ficar em branco, o sistema avisa em vermelho no topo da
            página o que precisa ser corrigido.</li>
            <li>Ao editar um item que já tem imagem ou anexo, se você <strong>não enviar um
            arquivo novo</strong>, o que já existia continua no ar.</li>
        </ul>
        <div class="tutorial-callout tip">
            <span class="label">Antes de excluir, pense duas vezes</span>
            <p class="mb-0">Não existe botão "desfazer". Excluir uma notícia, um evento, um
            membro da equipe ou uma imagem do carrossel é definitivo.</p>
        </div>
    </div>

    <div class="tutorial-section" id="permissoes">
        <h2>Sua conta e permissões</h2>
        <p>Existem três tipos de conta. O que muda entre elas é o acesso a áreas mais sensíveis —
        todo o resto do painel é igual para todo mundo.</p>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr><th style="width:160px">Nível</th><th>O que faz</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-danger">Administrador</span></td>
                        <td>Acesso total: todo o conteúdo do site, Configurações gerais, Logos,
                        Backup e a própria tela de Membros.</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary">Secretaria</span></td>
                        <td>Edita todo o conteúdo do site (notícias, editais, eventos, página
                        inicial, carrossel, sobre, serviços, graduação/pós, equipe, contato,
                        rodapé, tema e menu), mas não acessa Configurações gerais, Logos, Backup
                        nem Membros.</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-info text-dark">Bolsista</span></td>
                        <td>Mesmo acesso da Secretaria — a distinção hoje serve apenas para
                        identificar o cargo da pessoa na lista de membros.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-muted small mb-0">Se sua conta não é de Administrador, os itens restritos
        simplesmente não aparecem no seu menu — e tentar acessá-los pelo endereço direto também é
        bloqueado.</p>
    </div>

    <div class="tutorial-section" id="tema-cores">
        <h2>Tema e cores</h2>
        <p>
            Define a paleta de cores usada em botões, títulos e destaques em todo o site, na tela
            <a href="{{ route('admin.tema.edit') }}">Tema e Cores</a>. Há
            {{ count($paletas ?? []) }} paletas prontas para escolher:
        </p>
        <div class="tutorial-palette-grid">
            @foreach($paletas ?? [] as $paleta)
                <div class="tutorial-palette-card">
                    <div class="name">{{ $paleta['nome'] }}</div>
                    <div class="tutorial-swatches">
                        @foreach($paleta['cores'] as $cor)
                            <span style="background: {{ $cor }}"></span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <p class="mb-2">Na mesma tela, o interruptor <strong>"Menu transparente"</strong> deixa o
        menu do topo sobreposto à primeira imagem da página inicial, em vez de uma barra sólida —
        um visual mais moderno quando o carrossel tem fotos fortes.</p>
    </div>

    <div class="tutorial-section" id="logos">
        <h2>Logos</h2>
        <span class="badge bg-dark">Somente Administrador</span>
        <p class="mt-3 mb-2">São três imagens separadas, editadas em
        <a href="{{ route('admin.logos.edit') }}">Logos do site</a>, cada uma usada em um lugar
        diferente:</p>
        <ul class="tutorial-fields">
            <li><strong>Logo do menu principal</strong>
            <span>aparece no cabeçalho, sobre fundo sólido. Prefira PNG com fundo
            transparente.</span></li>
            <li><strong>Logo do menu (versão transparente)</strong>
            <span>usada automaticamente quando "Menu transparente" está ligado — precisa ficar
            legível sobre fotos, então prefira uma versão clara/branca da marca.</span></li>
            <li><strong>Logo do rodapé</strong>
            <span>aparece no canto inferior do site, sobre fundo escuro — o mesmo cuidado com
            contraste se aplica aqui.</span></li>
        </ul>
        <p class="text-muted small mb-0">Cada arquivo pode ter até 2&nbsp;MB.</p>
    </div>

    <div class="tutorial-section" id="menu-principal">
        <h2>Menu principal</h2>
        <p>
            Na tela <a href="{{ route('admin.menu.edit') }}">Menu principal</a> você liga ou
            desliga cada aba do menu de navegação do site: Início, O Departamento, Graduação,
            Pós-Graduação, Serviços, Notícias, Eventos, Pessoal e Contato.
        </p>
        <p>Desligar uma aba <strong>só a esconde do menu</strong> — a página continua existindo e
        pode ser acessada por quem tiver o link direto.</p>
        <div class="tutorial-callout tip">
            <span class="label">Eventos tem dois interruptores</span>
            <p class="mb-0">Além do interruptor aqui em Menu principal, a tela de
            <a href="#eventos">Eventos</a> tem o seu próprio — que controla se o quadro de
            "Próximos eventos" aparece na página inicial. Para o link "Eventos" aparecer no menu
            <em>e</em> o quadro aparecer na home, os dois precisam estar ligados.</p>
        </div>
    </div>

    <div class="tutorial-section" id="rodape">
        <h2>Rodapé</h2>
        <p>Tudo que aparece na faixa de baixo, em todas as páginas, editado em
        <a href="{{ route('admin.rodape.edit') }}">Rodapé do site</a>.</p>
        <ul class="tutorial-fields">
            <li><strong>Texto de descrição</strong>
            <span>frase curta sobre o departamento, logo abaixo da logo do rodapé.</span></li>
            <li><strong>Endereço, telefone e e-mail</strong>
            <span>exibidos no rodapé — podem ser diferentes dos informados na página de
            Contato.</span></li>
            <li><strong>Texto de direitos autorais</strong>
            <span>linha final, tipo "Todos os direitos reservados".</span></li>
        </ul>
        <p class="text-muted small mb-0">A logo do rodapé é trocada na tela
        <a href="#logos">Logos</a>, não aqui.</p>
    </div>

    <div class="tutorial-section" id="home">
        <h2>Boas-vindas e destaques</h2>
        <p>Editado em <a href="{{ route('admin.home.edit') }}">Página inicial</a>.</p>
        <ul class="tutorial-fields">
            <li><strong>Título principal e Subtítulo</strong>
            <span>o texto de boas-vindas em destaque no topo da página inicial.</span></li>
            <li><strong>Destaques</strong>
            <span>os cartões com ícone, título e texto curto logo abaixo. Use
            "+ Adicionar destaque" para incluir mais um, ou o "X" para remover.</span></li>
            <li><strong>Seção "Quem somos"</strong>
            <span>título, texto curto e imagem que aparecem mais abaixo na página inicial.</span></li>
        </ul>
    </div>

    <div class="tutorial-section" id="carrossel">
        <h2>Carrossel de imagens</h2>
        <span class="badge text-bg-light border">Aparece em: topo da página inicial</span>
        <p class="mt-3">A faixa de fotos que gira automaticamente no topo do site, editada em
        <a href="{{ route('admin.carrossel.edit') }}">Carrossel de imagens</a>.</p>
        <ol class="tutorial-steps">
            <li>Para trocar a foto de uma imagem já existente, use o campo <strong>Nova
            imagem</strong> da linha correspondente.</li>
            <li>A <strong>legenda</strong> é opcional; se preenchida, aparece por cima da foto.</li>
            <li>Use <strong>+ Adicionar imagem</strong> para incluir mais fotos, ou o
            <strong>X</strong> para remover.</li>
        </ol>
        <p class="text-muted small mb-0">Se a lista ficar vazia, o carrossel simplesmente não
        aparece. Cada imagem pode ter até 4&nbsp;MB.</p>
    </div>

    <div class="tutorial-section" id="destaque">
        <h2>Imagens de destaque</h2>
        <span class="badge text-bg-light border">Aparece em: página inicial</span>
        <p class="mt-3">Diferente do carrossel, aqui cada slide (em
        <a href="{{ route('admin.destaque.edit') }}">Imagens de destaque</a>) pode ter legenda,
        um texto maior e um link clicável — bom para chamar atenção para um edital importante ou
        uma divulgação específica.</p>
        <ul class="tutorial-fields">
            <li><strong>Imagem</strong><span>foto do slide (até 4&nbsp;MB).</span></li>
            <li><strong>Legenda</strong><span>texto curto sobre a imagem.</span></li>
            <li><strong>Texto</strong><span>frase de apoio, um pouco mais longa.</span></li>
            <li><strong>Link</strong><span>para onde o visitante vai ao clicar no slide
            (opcional).</span></li>
        </ul>
    </div>

    <div class="tutorial-section" id="noticias-editais">
        <h2>Notícias e Editais</h2>
        <span class="badge text-bg-light border">Aparece em: página inicial (6 mais recentes) e /noticias</span>
        <p class="mt-3">Diferente das outras seções, em
        <a href="{{ route('admin.noticias.index') }}">Notícias e Editais</a> existe uma
        <strong>lista de publicações</strong> — cada notícia ou edital é um item separado, com
        sua própria tela de criar/editar/excluir.</p>

        <h3 class="h6 mt-4">Publicar uma notícia ou edital novo</h3>
        <ol class="tutorial-steps">
            <li>Clique em <strong>+ Nova publicação</strong>.</li>
            <li>Escolha o <strong>Tipo</strong>: Notícia ou Edital.</li>
            <li>Preencha a <strong>Data de publicação</strong>, o <strong>Título</strong>, o
            <strong>Resumo</strong> (até 300 caracteres — aparece nos cartões da home e da
            listagem) e o <strong>Conteúdo completo</strong>.</li>
            <li>Se quiser, adicione uma <strong>Imagem de capa</strong> (até 4&nbsp;MB).</li>
            <li>Para editais, é comum anexar o documento oficial: use o campo
            <strong>Anexo</strong> para enviar um PDF, Word (.doc/.docx) ou Excel (.xls/.xlsx) de
            até 8&nbsp;MB.</li>
            <li>Clique em <strong>Publicar</strong>.</li>
        </ol>

        <h3 class="h6 mt-4">Editar ou excluir</h3>
        <p>Na lista, use os botões <strong>Editar</strong> ou <strong>Excluir</strong> na linha
        correspondente. Ao editar, se você não enviar uma imagem ou anexo novo, os que já
        existiam são mantidos.</p>
        <div class="tutorial-callout warn">
            <span class="label">Exclusão é definitiva</span>
            <p class="mb-0">Não há como recuperar uma notícia ou edital excluído.</p>
        </div>

        <h3 class="h6 mt-4">Onde aparecem</h3>
        <p class="mb-0">As <strong>6 publicações mais recentes</strong> (somando notícias e
        editais) aparecem automaticamente na página inicial. Todas ficam listadas em
        <code class="tutorial-code">/noticias</code>, com filtro por tipo e por ano.</p>
    </div>

    <div class="tutorial-section" id="eventos">
        <h2>Eventos</h2>
        <span class="badge text-bg-light border">Aparece em: menu, página inicial e /eventos</span>
        <p class="mt-3">Funciona de forma parecida com Notícias, mas para eventos com data
        marcada: palestras, seminários, prazos, defesas. Editado em
        <a href="{{ route('admin.eventos.index') }}">Eventos</a>.</p>
        <ol class="tutorial-steps">
            <li>No topo da tela existe o interruptor <strong>"Mostrar Eventos no menu
            principal"</strong>. Enquanto desligado, o quadro de "Próximos eventos" fica invisível
            na página inicial — os eventos continuam cadastrados, só não aparecem publicamente
            ali.</li>
            <li>Para criar um evento, clique em <strong>+ Novo evento</strong> e preencha
            Título, Data, Local (opcional), Descrição (opcional) e um Link com mais informações
            (opcional).</li>
        </ol>
        <div class="tutorial-callout tip">
            <span class="label">Só ligue quando já tiver um evento futuro</span>
            <p class="mb-0">Ligue o interruptor de Eventos apenas quando já houver pelo menos um
            evento futuro cadastrado. Lembre-se também do segundo interruptor, em
            <a href="#menu-principal">Menu principal</a>, que controla o link "Eventos" na barra
            de navegação.</p>
        </div>
    </div>

    <div class="tutorial-section" id="sobre">
        <h2>Sobre o Departamento</h2>
        <p>Editado em <a href="{{ route('admin.sobre.edit') }}">Sobre o departamento</a>.</p>
        <ul class="tutorial-fields">
            <li><strong>Título e Texto de introdução</strong>
            <span>resumo curto no topo da página.</span></li>
            <li><strong>Texto completo</strong>
            <span>pode ter vários parágrafos — deixe uma linha em branco entre eles para
            separá-los.</span></li>
            <li><strong>Imagem</strong><span>foto que ilustra a página (até 2&nbsp;MB).</span></li>
            <li><strong>Pontos rápidos</strong>
            <span>lista curta de destaques, ex.: "Atendimento humanizado", "Transparência nas
            informações".</span></li>
        </ul>
    </div>

    <div class="tutorial-section" id="servicos">
        <h2>Serviços</h2>
        <p>Lista dos serviços oferecidos pelo departamento ou laboratório, editada em
        <a href="{{ route('admin.servicos.edit') }}">Serviços</a>, cada um com ícone, título e
        descrição curta. Use "+ Adicionar serviço" / "X" para incluir ou remover itens, do mesmo
        jeito que nos destaques da página inicial.</p>
    </div>

    <div class="tutorial-section" id="cursos">
        <h2>Graduação e Pós-Graduação</h2>
        <p>Cada uma dessas duas páginas (<a href="{{ route('admin.graduacao.edit') }}">Graduação</a>
        e <a href="{{ route('admin.pos-graduacao.edit') }}">Pós-Graduação</a>) lista os cursos ou
        programas do departamento.</p>
        <ol class="tutorial-steps">
            <li>Marque ou desmarque <strong>"Mostrar no menu principal"</strong> para exibir ou
            esconder o item correspondente no menu — a página continua existindo, só não aparece
            no menu quando desmarcada.</li>
            <li>Para cada curso, informe o <strong>Nome</strong> e, se quiser, um
            <strong>Link</strong> (para a página oficial do curso, o SIGAA, ou onde fizer mais
            sentido).</li>
        </ol>
    </div>

    <div class="tutorial-section" id="pessoal">
        <h2>Pessoal</h2>
        <p>Lista de docentes e funcionários, editada em
        <a href="{{ route('admin.pessoal.edit') }}">Pessoal</a>, organizada em duas abas no site
        (Docentes / Funcionários).</p>
        <ol class="tutorial-steps">
            <li>Para cada pessoa, preencha Nome, Cargo/função, escolha a Categoria (Docente ou
            Funcionário) e, se quiser, envie uma foto.</li>
            <li>Use <strong>+ Adicionar membro</strong> para incluir alguém novo, ou o
            <strong>X</strong> para remover.</li>
            <li>A opção <strong>"Mostrar no menu principal"</strong> liga ou desliga o dropdown
            "Pessoal" inteiro no menu do site.</li>
        </ol>
    </div>

    <div class="tutorial-section" id="contato">
        <h2>Contato</h2>
        <p>Endereço, telefones, e-mails e o mapa que aparecem na página de Contato do site,
        editados em <a href="{{ route('admin.contato.edit') }}">Contato</a> (campos independentes
        dos que ficam no rodapé).</p>
        <div class="tutorial-callout tip">
            <span class="label">Como pegar o link do mapa</span>
            <p class="mb-0">Abra o Google Maps, encontre o endereço do departamento, clique em
            <strong>Compartilhar → Incorporar um mapa</strong>, e copie apenas o endereço que
            aparece dentro de <code class="tutorial-code">src="..."</code>. Cole esse endereço no
            campo <strong>Link do mapa</strong>.</p>
        </div>
    </div>

    <div class="tutorial-section" id="membros">
        <h2>Membros da equipe</h2>
        <span class="badge bg-dark">Somente Administrador</span>
        <p class="mt-3">Além da conta raiz configurada no servidor (sempre nível Administrador),
        a tela <a href="{{ route('admin.membros.index') }}">Membros da equipe</a> permite
        cadastrar outras contas de acesso ao painel.</p>
        <ol class="tutorial-steps">
            <li>Clique em <strong>+ Novo membro</strong> e preencha nome, e-mail, senha e o nível
            de acesso (Administrador, Secretaria ou Bolsista — veja a diferença em
            <a href="#permissoes">Sua conta e permissões</a>).</li>
            <li>Para editar ou remover alguém, use os botões na linha correspondente.</li>
        </ol>
        <p class="text-muted small mb-0">Por segurança, uma conta não pode excluir a si mesma pelo
        painel. Se precisar remover a própria conta, peça para outro administrador fazer isso.</p>
    </div>

    <div class="tutorial-section" id="backup">
        <h2>Backup e restauração</h2>
        <span class="badge bg-dark">Somente Administrador</span>
        <p class="mt-3">Como o site não usa banco de dados, todo o "dado" dele é o conteúdo
        editado pelo painel mais as imagens enviadas. A tela
        <a href="{{ route('admin.backup.index') }}">Backup do site</a> é a forma mais simples de
        se proteger contra perda de conteúdo.</p>
        <ul class="tutorial-fields">
            <li><strong>Baixar backup completo agora</strong>
            <span>gera na hora um .zip com todo o conteúdo do site e baixa direto para o
            computador. Guarde o arquivo fora do servidor (pendrive, nuvem pessoal, e-mail para si
            mesmo).</span></li>
            <li><strong>Restaurar a partir de um backup</strong>
            <span>reenvie um desses .zip pelo painel; o sistema substitui totalmente o conteúdo
            atual pelo que está no arquivo.</span></li>
        </ul>
        <div class="tutorial-callout warn">
            <span class="label">Antes de restaurar</span>
            <p class="mb-0">O sistema cria automaticamente uma cópia de segurança do estado atual
            antes de qualquer restauração — mas isso é um complemento, não substitui manter seus
            próprios backups baixados.</p>
        </div>
    </div>

    <div class="tutorial-section" id="adaptar">
        <h2>Usando este modelo para outro departamento ou laboratório</h2>
        <p>Como quase tudo é editável pelo painel, o mesmo modelo de site atende qualquer
        departamento, laboratório ou grupo de pesquisa — só muda o conteúdo.</p>
        <ol class="tutorial-steps">
            <li>A equipe técnica responsável pela implantação copia o projeto para o novo site e
            ajusta o nome do site e a conta de administrador inicial.</li>
            <li>Assim que o site sobe no ar, quem for cuidar do conteúdo entra em
            <code class="tutorial-code">/admin</code> e preenche, na ordem que preferir:
            Configurações gerais (nome, sigla, logo), Tema e Cores, Logos, Menu principal, e então
            o conteúdo de cada página (Sobre, Serviços, Pessoal, Contato, e por aí vai).</li>
            <li>Não é necessário mexer em nenhum código para o uso básico — a estrutura de seções
            já cobre o que um site institucional típico precisa.</li>
        </ol>
    </div>

    <div class="tutorial-section" id="faq">
        <h2>Perguntas frequentes</h2>
        <ul class="tutorial-fields">
            <li><strong>Salvei, mas não vejo a mudança no site.</strong>
            <span>Atualize a página do site (tecla F5) — às vezes o navegador guarda uma versão
            antiga em memória.</span></li>
            <li><strong>A imagem que enviei não aparece direito.</strong>
            <span>Confira se o arquivo é realmente uma imagem (JPG, PNG ou similar) e se não é
            grande demais. Se persistir, tente salvar a mesma foto em outro formato.</span></li>
            <li><strong>Errei e quero desfazer uma alteração.</strong>
            <span>Não existe um botão "desfazer" — a forma mais simples é editar o campo de novo,
            colocando o valor de volta como estava.</span></li>
            <li><strong>Esqueci minha senha.</strong>
            <span>Somente quem administra o servidor consegue gerar uma senha nova, por linha de
            comando.</span></li>
            <li><strong>Posso acessar o painel pelo celular?</strong>
            <span>Sim, as telas se ajustam a telas menores, mas preencher formulários grandes
            costuma ser mais confortável num computador.</span></li>
        </ul>
    </div>

    <div class="tutorial-section" id="ajuda">
        <h2>Precisa de ajuda?</h2>
        <p class="mb-0">Se alguma dúvida não foi respondida neste tutorial, entre em contato com
        quem administra o servidor do site — a equipe técnica responsável pela implantação.</p>
    </div>
@endsection

@push('styles')
    <style>
        .tutorial-eyebrow {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--brand-wine);
            font-weight: 700;
            margin-bottom: .25rem;
        }
        .tutorial-toc {
            columns: 2;
            column-gap: 2rem;
            border: 1px solid #d6dde6;
            border-radius: 8px;
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            margin: 1.25rem 0 .5rem;
        }
        @media (max-width: 767.98px) {
            .tutorial-toc { columns: 1; }
        }
        .tutorial-toc-group {
            break-inside: avoid;
            margin-bottom: 1.1rem;
        }
        .tutorial-toc-group h3 {
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #7b8794;
            margin-bottom: .35rem;
            font-weight: 700;
        }
        .tutorial-toc-group a {
            display: block;
            font-size: .9rem;
            padding: .15rem 0;
            color: #071323;
            text-decoration: none;
        }
        .tutorial-toc-group a:hover {
            color: var(--brand-wine);
            text-decoration: underline;
        }
        .tutorial-section {
            padding: 1.75rem 0;
            border-top: 1px solid #e9ecef;
            scroll-margin-top: 1rem;
        }
        .tutorial-section:first-of-type { border-top: none; }
        .tutorial-section h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #071323;
            margin-bottom: .75rem;
        }
        .tutorial-callout {
            border-radius: .5rem;
            padding: .9rem 1.1rem;
            margin: 1rem 0;
            border: 1px solid;
        }
        .tutorial-callout.tip {
            background: rgba(var(--brand-wine-rgb), .06);
            border-color: rgba(var(--brand-wine-rgb), .25);
        }
        .tutorial-callout.warn {
            background: #fff7e6;
            border-color: #f0c36d;
        }
        .tutorial-callout .label {
            font-weight: 700;
            display: block;
            margin-bottom: .15rem;
            font-size: .85rem;
        }
        .tutorial-callout.tip .label { color: var(--brand-wine); }
        .tutorial-callout.warn .label { color: #8a5a00; }

        .tutorial-fields { list-style: none; padding: 0; margin: 1rem 0; }
        .tutorial-fields li {
            border-left: 2px solid #dee2e6;
            padding-left: .9rem;
            margin-bottom: .75rem;
        }
        .tutorial-fields strong { display: block; font-size: .92rem; }
        .tutorial-fields span { color: #6c757d; font-size: .88rem; }

        .tutorial-steps { list-style: none; padding: 0; margin: 1rem 0; counter-reset: step; }
        .tutorial-steps li {
            counter-increment: step;
            position: relative;
            padding-left: 2.3rem;
            margin-bottom: .8rem;
        }
        .tutorial-steps li::before {
            content: counter(step);
            position: absolute;
            left: 0;
            top: -.05rem;
            width: 1.6rem;
            height: 1.6rem;
            border-radius: 50%;
            border: 1.5px solid var(--brand-wine);
            color: var(--brand-wine);
            font-weight: 700;
            font-size: .78rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tutorial-palette-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: .65rem;
            margin: 1rem 0 1.25rem;
        }
        .tutorial-palette-card {
            border: 1px solid #dee2e6;
            border-radius: .5rem;
            padding: .6rem .7rem;
        }
        .tutorial-palette-card .name {
            font-weight: 600;
            font-size: .8rem;
            margin-bottom: .4rem;
        }
        .tutorial-swatches {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 4px;
        }
        .tutorial-swatches span {
            height: 18px;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, .12);
        }

        code.tutorial-code {
            background: #eef0f2;
            color: #3b4652;
            padding: .1em .4em;
            border-radius: 4px;
            font-size: .85em;
        }
    </style>
@endpush
