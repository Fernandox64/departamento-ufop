<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Gera a linha pronta para colar no .env a partir de uma senha em texto puro.
 *
 * O hash bcrypt (Hash::make) sempre comeca com "$2y$12$..." e o Docker Compose
 * reinterpreta "$" seguido de letras como se fosse outra variavel de ambiente,
 * truncando o valor sem avisar (silenciosamente vira uma senha vazia). Por
 * isso guardamos o hash codificado em base64 no .env (ADMIN_PASSWORD_HASH_B64)
 * — base64 nunca usa "$", entao esse problema nao acontece mais.
 */
class GerarSenhaAdmin extends Command
{
    protected $signature = 'admin:senha {senha : A nova senha do admin, em texto puro}';

    protected $description = 'Gera a linha ADMIN_PASSWORD_HASH_B64 pronta para colar no .env';

    public function handle(): int
    {
        $hash = Hash::make($this->argument('senha'));
        $codificado = base64_encode($hash);

        $this->newLine();
        $this->info('Cole esta linha no seu .env (substitua a linha ADMIN_PASSWORD_HASH_B64 que ja existe):');
        $this->newLine();
        $this->line("ADMIN_PASSWORD_HASH_B64={$codificado}");
        $this->newLine();
        $this->comment('Depois de salvar o .env, reinicie com: docker compose up -d');
        $this->newLine();

        return self::SUCCESS;
    }
}
