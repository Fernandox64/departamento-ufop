<?php

namespace App\Support;

class ContentStore
{
    public static function directory(): string
    {
        return storage_path('content');
    }

    protected static function path(string $key): string
    {
        return static::directory()."/{$key}.json";
    }

    protected static function legacyPath(string $key): string
    {
        return storage_path("app/private/content/{$key}.json");
    }

    /**
     * Le o JSON salvo (se existir) e mescla por cima dos valores padrao,
     * assim o site sempre tem conteudo mesmo antes da primeira edicao.
     */
    public static function get(string $key, array $defaults = []): array
    {
        $path = static::path($key);
        $legacyPath = static::legacyPath($key);

        if (is_file($path)) {
            $saved = json_decode((string) file_get_contents($path), true);
        } elseif (is_file($legacyPath)) {
            $saved = json_decode((string) file_get_contents($legacyPath), true);
        } else {
            return $defaults;
        }

        if (! is_array($saved)) {
            return $defaults;
        }

        return array_replace($defaults, $saved);
    }

    public static function save(string $key, array $data): void
    {
        $directory = static::directory();
        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            throw new \RuntimeException('Nao foi possivel criar a pasta de conteudo do site.');
        }

        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new \RuntimeException('Nao foi possivel preparar o conteudo para salvar.');
        }

        $written = file_put_contents(static::path($key), $json, LOCK_EX);
        if ($written === false) {
            throw new \RuntimeException('Nao foi possivel salvar o conteudo. Verifique a permissao da pasta storage/content.');
        }
    }
}
