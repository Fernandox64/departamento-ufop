# Site institucional (departamento) — notas do projeto

- Laravel + Blade, **sem banco de dados**. Nao rode migrations nem crie models Eloquent para
  conteudo do site — tudo fica em JSON via `App\Support\ContentStore` (ver `README.md`).
- Ambiente e 100% Docker (`docker compose up -d --build`). PHP/Composer nao precisam estar
  instalados localmente; nao é necessário instalar o Laravel Boost para este projeto.
- Login do admin e uma conta unica via `ADMIN_EMAIL`/`ADMIN_PASSWORD_HASH` no `.env`
  (`app/Http/Controllers/Admin/AuthController.php`), sem tabela de usuarios.
- Conteudo editavel (`storage/app/private/content/*.json`) e imagens enviadas
  (`storage/app/public/uploads/`) sao persistidos via volume Docker — ver `docker-compose.yml`.
- Tema visual (HTML/CSS original) esta em `../neoton-html-full-package/` como referencia; as
  views Blade em `resources/views/` sao a adaptacao usada de fato.
