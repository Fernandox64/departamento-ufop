<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploader
{
    /**
     * Salva a imagem enviada em storage/app/public/uploads e devolve o caminho
     * publico (ex.: "storage/uploads/xxx.jpg"). Se nenhum arquivo for enviado,
     * devolve o valor atual (mantem a imagem ja cadastrada).
     */
    public static function store(?UploadedFile $file, string $current = ''): string
    {
        if (! $file) {
            return $current;
        }

        // Usa a extensao detectada pelo conteudo real do arquivo (nao o nome que
        // o navegador enviou), para evitar que um arquivo malicioso disfarçado
        // de imagem/documento com extensao falsa seja salvo com nome enganoso.
        $extensao = $file->extension() ?: $file->getClientOriginalExtension();
        $name = Str::random(20).'.'.$extensao;
        $file->storeAs('uploads', $name, 'public');

        return 'storage/uploads/'.$name;
    }
}
