<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class ImageUploader
{
    public static function store(?UploadedFile $file, string $current = ''): string
    {
        if (! $file) {
            return $current;
        }

        if (! $file->isValid()) {
            throw ValidationException::withMessages([
                'arquivo' => 'O upload falhou antes de chegar ao site. Tente novamente com um arquivo menor.',
            ]);
        }

        if (! ClamAvScanner::isSafe($file->getRealPath())) {
            throw ValidationException::withMessages([
                'arquivo' => 'O arquivo enviado foi identificado como potencialmente malicioso pelo antivirus e nao foi salvo.',
            ]);
        }

        // Usa a extensao detectada pelo conteudo real do arquivo (nao o nome que
        // o navegador enviou), para evitar que um arquivo malicioso disfarçado
        // de imagem/documento com extensao falsa seja salvo com nome enganoso.
        $extensao = $file->extension() ?: $file->getClientOriginalExtension();
        $name = Str::random(20).'.'.$extensao;

        foreach (self::uploadDirectories() as $target) {
            if (! self::ensureWritableDirectory($target['directory'])) {
                continue;
            }

            try {
                $file->move($target['directory'], $name);

                return $target['public'].'/'.$name;
            } catch (Throwable) {
                continue;
            }
        }

        throw ValidationException::withMessages([
            'arquivo' => 'Nao foi possivel salvar o arquivo. Verifique a permissao das pastas public/uploads e storage/app/public/uploads.',
        ]);
    }

    protected static function uploadDirectories(): array
    {
        return [
            [
                'directory' => public_path('uploads'),
                'public' => 'uploads',
            ],
            [
                'directory' => storage_path('app/public/uploads'),
                'public' => 'storage/uploads',
            ],
        ];
    }

    protected static function ensureWritableDirectory(string $directory): bool
    {
        if (! is_dir($directory) && ! @mkdir($directory, 0755, true) && ! is_dir($directory)) {
            return false;
        }

        return is_writable($directory);
    }
}
