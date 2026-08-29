<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class ContentStore
{
    protected static function disk()
    {
        return Storage::disk('local');
    }

    protected static function path(string $key): string
    {
        return "content/{$key}.json";
    }

    /**
     * Le o JSON salvo (se existir) e mescla por cima dos valores padrao,
     * assim o site sempre tem conteudo mesmo antes da primeira edicao.
     */
    public static function get(string $key, array $defaults = []): array
    {
        $disk = static::disk();
        $path = static::path($key);

        if (! $disk->exists($path)) {
            return $defaults;
        }

        $saved = json_decode($disk->get($path), true);

        if (! is_array($saved)) {
            return $defaults;
        }

        return array_replace($defaults, $saved);
    }

    public static function save(string $key, array $data): void
    {
        static::disk()->put(
            static::path($key),
            json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
        );
    }
}
