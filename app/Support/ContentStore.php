<?php

namespace App\Support;

class ContentStore
{
    public static function directory(): string
    {
        return storage_path('content');
    }

    public static function directories(): array
    {
        return [
            static::directory(),
            storage_path('app/private/content'),
        ];
    }

    public static function files(): array
    {
        $files = [];

        foreach (static::directories() as $directory) {
            foreach (glob($directory.'/*.json') ?: [] as $file) {
                $name = basename($file);
                if (! isset($files[$name]) || filemtime($file) > filemtime($files[$name])) {
                    $files[$name] = $file;
                }
            }
        }

        return array_values($files);
    }

    protected static function paths(string $key): array
    {
        return array_map(
            fn ($directory) => $directory."/{$key}.json",
            static::directories()
        );
    }

    /**
     * Le o JSON salvo (se existir) e mescla por cima dos valores padrao,
     * assim o site sempre tem conteudo mesmo antes da primeira edicao.
     */
    public static function get(string $key, array $defaults = []): array
    {
        $paths = array_values(array_filter(static::paths($key), 'is_file'));
        usort($paths, fn ($a, $b) => filemtime($b) <=> filemtime($a));

        if (empty($paths)) {
            return $defaults;
        }

        $saved = json_decode((string) file_get_contents($paths[0]), true);

        if (! is_array($saved)) {
            return $defaults;
        }

        return array_replace($defaults, $saved);
    }

    public static function save(string $key, array $data): void
    {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new \RuntimeException('Nao foi possivel preparar o conteudo para salvar.');
        }

        $saved = false;
        foreach (static::directories() as $directory) {
            if (! is_dir($directory) && ! @mkdir($directory, 0755, true) && ! is_dir($directory)) {
                continue;
            }

            if (! is_writable($directory)) {
                continue;
            }

            $written = @file_put_contents($directory."/{$key}.json", $json, LOCK_EX);
            $saved = $saved || $written !== false;
        }

        if (! $saved) {
            throw new \RuntimeException('Nao foi possivel salvar o conteudo. Verifique a permissao das pastas storage/content e storage/app/private/content.');
        }
    }
}
