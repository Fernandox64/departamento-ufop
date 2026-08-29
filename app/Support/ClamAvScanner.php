<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;

/**
 * Fala diretamente com o daemon clamd (protocolo INSTREAM) via socket TCP,
 * sem depender de nenhuma biblioteca PHP externa. Usado para escanear todo
 * arquivo enviado pelo painel admin (imagens e anexos de noticias/editais)
 * antes de salvar, procurando assinaturas de virus/malware conhecidos.
 */
class ClamAvScanner
{
    /**
     * @return bool true se o arquivo pode ser salvo (limpo, ou scan desligado/indisponivel
     *              com fail_closed=false); false se foi identificado como infectado.
     */
    public static function isSafe(string $filePath): bool
    {
        if (! config('clamav.enabled')) {
            return true;
        }

        try {
            return self::scan($filePath) !== self::INFECTED;
        } catch (\Throwable $e) {
            Log::channel('admin')->error('clamav_indisponivel', [
                'erro' => $e->getMessage(),
                'arquivo' => basename($filePath),
            ]);

            // Sem resposta do ClamAV: decide pelo modo configurado.
            return ! config('clamav.fail_closed');
        }
    }

    protected const CLEAN = 'clean';
    protected const INFECTED = 'infected';

    protected static function scan(string $filePath): string
    {
        $host = config('clamav.host');
        $port = (int) config('clamav.port');
        $timeout = (int) config('clamav.timeout');

        $socket = @stream_socket_client("tcp://{$host}:{$port}", $errno, $errstr, $timeout);

        if (! $socket) {
            throw new \RuntimeException("Nao foi possivel conectar ao ClamAV ({$host}:{$port}): {$errstr}");
        }

        stream_set_timeout($socket, $timeout);

        fwrite($socket, "zINSTREAM\0");

        $handle = fopen($filePath, 'rb');
        if (! $handle) {
            fclose($socket);
            throw new \RuntimeException("Nao foi possivel abrir o arquivo para escanear: {$filePath}");
        }

        while (! feof($handle)) {
            $chunk = fread($handle, 8192);
            if ($chunk === false || $chunk === '') {
                break;
            }
            // Protocolo INSTREAM: cada pedaco vem precedido do seu tamanho em 4 bytes (big-endian).
            fwrite($socket, pack('N', strlen($chunk)).$chunk);
        }
        fclose($handle);

        // Pedaco de tamanho zero avisa o clamd que o arquivo terminou.
        fwrite($socket, pack('N', 0));

        $response = '';
        while (! feof($socket)) {
            $line = fread($socket, 4096);
            if ($line === false) {
                break;
            }
            $response .= $line;
        }
        fclose($socket);

        if (str_contains($response, 'FOUND')) {
            Log::channel('admin')->warning('clamav_arquivo_infectado', [
                'arquivo' => basename($filePath),
                'resposta' => trim($response),
            ]);

            return self::INFECTED;
        }

        if (str_contains($response, 'OK')) {
            return self::CLEAN;
        }

        throw new \RuntimeException("Resposta inesperada do ClamAV: ".trim($response));
    }
}
