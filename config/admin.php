<?php

return [
    'email' => env('ADMIN_EMAIL', 'admin@departamento.br'),

    // Guardado em base64 no .env (ver comando "php artisan admin:senha") porque
    // o hash bcrypt cru (com "$") e reinterpretado/truncado pelo Docker Compose
    // ao carregar o .env.
    'password_hash' => base64_decode(env('ADMIN_PASSWORD_HASH_B64', '')) ?: null,
];
