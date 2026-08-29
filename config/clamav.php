<?php

return [

    // Desligado por padrao: so ative depois de subir o servico "clamav" (veja
    // docker-compose.yml, perfil "clamav") e confirmar que ele esta pronto.
    'enabled' => env('CLAMAV_ENABLED', false),

    'host' => env('CLAMAV_HOST', 'clamav'),
    'port' => env('CLAMAV_PORT', 3310),
    'timeout' => env('CLAMAV_TIMEOUT', 15),

    // Se o ClamAV estiver ligado mas ficar inacessivel (fora do ar, timeout):
    // false = deixa o upload passar mesmo sem escanear (so registra no log) -
    //         evita que uma falha no antivirus impeca a secretaria de trabalhar.
    // true  = bloqueia o upload ate o ClamAV voltar a responder.
    'fail_closed' => env('CLAMAV_FAIL_CLOSED', false),

];
