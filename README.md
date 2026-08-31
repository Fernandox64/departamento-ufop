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

Credenciais de admin: definidas em `.env` (`ADMIN_EMAIL` / `ADMIN_PASSWORD_HASH_B64`).
A senha padrao inicial e `Trocar@123` — troque assim que possivel:

```bash
docker compose exec app php artisan admin:senha "nova-senha"
```

O comando imprime a linha pronta para colar no `.env` (ex.: `ADMIN_PASSWORD_HASH_B64=...`).
Cole, salve o arquivo e reinicie com `docker compose up -d`.

> **Por que base64 e nao o hash direto?** O hash bcrypt sempre comeca com `$2y$12$...`, e o
> Docker Compose reinterpreta `$` seguido de letras como se fosse outra variavel de ambiente,
> truncando o valor silenciosamente (sem erro, so o login para de funcionar). Guardando em
> base64 esse problema nunca acontece — por isso o comando `admin:senha` faz essa conversao
> automaticamente, em vez de usar `php artisan tinker` + `Hash::make` diretamente.

## Membros da equipe e niveis de permissao

Alem da conta raiz do `.env` (sempre nivel administrador), o painel em `/admin/membros`
(visivel so para administradores) permite cadastrar outras contas com dois niveis:

- **Administrador**: acesso total — todas as secoes de conteudo, Configuracoes gerais, Backup
  e a propria tela de Membros.
- **Secretaria**: edita o conteudo do site (noticias, eventos, home, carrossel, sobre, servicos,
  graduacao/pos-graduacao, equipe, contato, rodape), mas nao acessa Configuracoes gerais, Backup
  nem Membros — tanto o menu quanto o acesso direto pela URL sao bloqueados (403).

Guardado em `storage/app/private/content/membros.json` (mesmo padrao de noticias/eventos), com
senha em bcrypt. Uma conta nao pode excluir a si mesma pelo painel (evita ficar sem acesso por
engano) — se precisar remover a propria conta, peça para outro administrador fazer isso.

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
2. Ajuste `APP_NAME`, `ADMIN_EMAIL` e gere uma nova senha no `.env` (`php artisan admin:senha "..."`).
3. Suba o container e edite todo o conteudo pelo `/admin` (nome, logos, textos, equipe, contato).
4. Nao ha necessidade de editar Blade/PHP para o uso basico — a estrutura de secoes ja cobre
   o que um site institucional tipico precisa.

## Deploy (Hostinger / qualquer host com Docker)

- Build da imagem com `docker compose build` e suba com `docker compose up -d`.
- Garanta que os volumes `./storage/content` e `./storage/uploads` (definidos no
  `docker-compose.yml`) fiquem em um disco persistente — e ali que moram as edicoes da
  secretaria e as imagens enviadas. Sem esse volume, tudo volta ao padrao a cada rebuild/deploy.
- Configure `APP_URL` com o dominio final e `APP_DEBUG=false` em producao.

## Seguranca

Medidas ja implementadas no codigo:

- **Sem banco de dados** — elimina SQL injection por completo, e todo conteudo do admin passa
  pelo escape automatico do Blade (`{{ }}`), sem renderizar HTML — elimina a maior parte dos
  vetores de XSS armazenado.
- **Limite de tentativas de login**: 5 por minuto, por combinacao de e-mail + IP
  (`app/Providers/AppServiceProvider.php`, limiter `login`).
- **Log de auditoria** em `storage/logs/admin-*.log`: login (sucesso/falha) e toda acao que
  muda conteudo (POST/PUT/DELETE dentro do `/admin`), com rota, IP e horario.
- **Cabecalhos de seguranca HTTP** (`app/Http/Middleware/SecurityHeaders.php`):
  `X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy` e uma
  `Content-Security-Policy` restritiva (nao usamos nenhum CDN externo).
- **Uploads**: extensao do arquivo salvo e detectada pelo conteudo real (nao pelo nome que o
  navegador envia), e o Apache recusa (403) qualquer tentativa de executar PHP a partir de
  `/storage/*` — mesmo que um arquivo malicioso passasse pela validacao de upload, ele nunca
  seria executado como script.
- **HTTPS opcional**: `FORCE_HTTPS=true` no `.env` redireciona tudo para HTTPS. Fica desligado
  por padrao — so ative depois de confirmar que o dominio final tem certificado configurado,
  senao o site fica inacessivel (loop de redirecionamento).
- **Antivirus nos uploads (opcional)**: todo arquivo enviado pelo painel (imagens e anexos de
  noticias/editais) pode ser escaneado por um ClamAV rodando em container separado, via
  `app/Support/ClamAvScanner.php` (fala direto com o clamd pelo protocolo INSTREAM, sem
  dependencia PHP extra). Cobre o cenario que a validacao de tipo de arquivo sozinha nao pega:
  um documento Word/Excel com macro maliciosa que passaria pela validacao normal por ser, de
  fato, um arquivo daquele tipo.
  - Ativar: `CLAMAV_ENABLED=true` no `.env` e subir o servico junto:
    `docker compose --profile clamav up -d --build`.
  - Na primeira vez, o ClamAV baixa o banco de assinaturas — pode levar alguns minutos ate
    ficar pronto. Acompanhe com `docker compose logs -f clamav`.
  - Se o ClamAV cair ou ficar fora do ar depois de ativado, por padrao os uploads continuam
    funcionando normalmente (so fica registrado um aviso no log) — para bloquear uploads nesse
    caso em vez de deixar passar, use `CLAMAV_FAIL_CLOSED=true`.

Fora do codigo (vale considerar ao publicar de verdade):
- Trocar a senha padrao do admin (`Trocar@123`) antes de ir ao ar.
- Manter o Laravel e as dependencias do `composer.json` atualizados.
- Se algum dia rodar comandos `artisan` manualmente dentro do container via `docker exec` (sem
  passar por `docker compose exec`, que ja roda como o usuario certo), rode depois
  `docker exec <container> chown -R www-data:www-data storage bootstrap/cache` — comandos
  executados como root podem deixar arquivos de log/cache com dono errado e quebrar escritas
  seguintes do Apache.

## Backup

Como o site nao usa banco de dados, todo o "dado" dele e `storage/content/*.json` +
`storage/uploads/`. O painel `/admin/backup` cobre a forma mais simples de se proteger contra uma
invasao: **baixar uma copia pro seu proprio computador e usa-la pra restaurar o site depois, se
precisar.**

- **Baixar backup completo agora**: gera na hora um `.zip` com todo o conteudo (`content/` +
  `uploads/`) e baixa direto pro navegador do admin. Nada fica guardado no servidor depois do
  download. Recomendado repetir isso periodicamente e sempre apos mudancas importantes — guarde
  os arquivos fora do servidor (pendrive, nuvem pessoal, e-mail para si mesmo etc.), porque um
  backup que mora no mesmo servidor que pode ser invadido nao protege contra invasao.
- **Restaurar a partir de um backup**: o admin reenvia um desses `.zip` pelo painel; o sistema
  substitui totalmente `storage/content/` e `storage/uploads/` pelo conteudo do arquivo
  (`app/Support/BackupManager.php`). Passa pelo mesmo antivirus (ClamAV, quando ligado) que os
  demais uploads do site, e valida a estrutura interna do zip contra "zip slip" (entradas tentando
  escapar da pasta de destino) antes de extrair qualquer coisa.
- **Rede de seguranca extra**: antes de qualquer restauracao, o sistema cria automaticamente uma
  copia do estado atual em `storage/backups-seguranca/` (fora do alcance da web, persistida por
  volume Docker) — protege contra restaurar o arquivo errado por engano. Isso e um complemento,
  nao substitui manter seus proprios backups baixados.

Isso resolve o cenario "o site foi invadido, preciso voltar para uma versao boa conhecida" sem
depender de nenhum servidor externo. Um proximo passo natural (nao implementado ainda) seria um
historico automatico de versoes (ex.: Git) com restauracao de um clique direto pelo painel, para
nao depender de o admin ter feito o download manualmente antes do incidente.

## Tema

O HTML/CSS original (tema "Neoton") esta em `../neoton-html-full-package/` como referencia.
Os arquivos usados neste projeto foram adaptados para Blade em `resources/views/`, mantendo os
mesmos estilos (`public/assets/css`, `public/assets/js`, `public/assets/images`).
