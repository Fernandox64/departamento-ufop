# Template de site institucional (departamento)

Site institucional simples (Laravel + Blade, tema Neoton adaptado), **sem banco de dados**.
Todo o conteudo editavel fica em arquivos JSON (`storage/app/private/content/*.json`) e imagens
enviadas ficam em `storage/app/public/uploads/`, ambos persistidos via volume Docker.

## Rodando localmente

```bash
docker compose up -d --build
```

Site: http://localhost:8097
Painel admin: http://localhost:8097/admin/login

Credenciais de admin: definidas em `.env` (`ADMIN_EMAIL` / `ADMIN_PASSWORD_HASH`).
A senha padrao inicial e `Trocar@123` — troque assim que possivel gerando um novo hash:

```bash
docker compose exec app php artisan tinker --execute="echo Hash::make('nova-senha');"
```

E depois atualize `ADMIN_PASSWORD_HASH` no `.env` (ou nas variaveis de ambiente do deploy) e
reinicie o container.

## Estrutura de conteudo

Cada pagina tem um arquivo JSON proprio, com valores padrao definidos em
`app/Support/ContentDefaults.php` (usados enquanto o arquivo ainda nao existe):

- `configuracoes.json` — nome do site, logo do cabecalho, redes sociais.
- `rodape.json` — tudo que aparece no rodape: imagem do canto inferior esquerdo, texto, endereco/telefone/e-mail exibidos ali e o texto de direitos autorais.
- `home.json` — titulo/subtitulo da pagina inicial e os cards de destaque.
- `carrossel.json` — imagens (com legenda opcional) do carrossel no topo da pagina inicial.
- `noticias.json` — lista de noticias e editais (titulo, resumo, conteudo, imagem, anexo opcional). Diferente das outras, esta secao tem tela propria de listar/criar/editar/excluir em `/admin/noticias`, nao um unico formulario.
- `eventos.json` — lista de eventos (titulo, data, local, descricao, link), com CRUD proprio em `/admin/eventos` e um campo `mostrar_menu` (liga/desliga o item "Eventos" no menu E o quadro de eventos na home ao mesmo tempo).
- `sobre.json` — texto e imagem da pagina "Sobre o Departamento".
- `servicos.json` — lista de servicos oferecidos.
- `graduacao.json` / `pos_graduacao.json` — lista de cursos/programas (nome + link) de cada pagina, com um campo `mostrar_menu` que liga/desliga o item correspondente no menu principal sem remover a pagina do ar.
- `equipe.json` — lista de membros da equipe (nome, cargo, foto).
- `contato.json` — endereco, telefones, e-mails e link do mapa.

Tudo isso e editado pelo painel `/admin`, sem precisar mexer em codigo. Nao ha cadastro de
usuarios nem banco de dados: existe apenas uma conta de admin, configurada por variavel de
ambiente.

## Reaproveitando para um novo departamento

1. Copie esta pasta (`site/`) para o novo projeto.
2. Ajuste `APP_NAME`, `ADMIN_EMAIL` e gere um novo `ADMIN_PASSWORD_HASH` no `.env`.
3. Suba o container e edite todo o conteudo pelo `/admin` (nome, logos, textos, equipe, contato).
4. Nao ha necessidade de editar Blade/PHP para o uso basico — a estrutura de secoes ja cobre
   o que um site institucional tipico precisa.

## Deploy (Hostinger / qualquer host com Docker)

- Build da imagem com `docker compose build` e suba com `docker compose up -d`.
- Garanta que os volumes `./storage/content` e `./storage/uploads` (definidos no
  `docker-compose.yml`) fiquem em um disco persistente — e ali que moram as edicoes da
  secretaria e as imagens enviadas. Sem esse volume, tudo volta ao padrao a cada rebuild/deploy.
- Configure `APP_URL` com o dominio final e `APP_DEBUG=false` em producao.

## Tema

O HTML/CSS original (tema "Neoton") esta em `../neoton-html-full-package/` como referencia.
Os arquivos usados neste projeto foram adaptados para Blade em `resources/views/`, mantendo os
mesmos estilos (`public/assets/css`, `public/assets/js`, `public/assets/images`).
