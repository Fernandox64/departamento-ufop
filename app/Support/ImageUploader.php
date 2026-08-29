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

        $name = Str::random(20).'.'.$file->getClientOriginalExtension();
        $file->storeAs('uploads', $name, 'public');

        return 'storage/uploads/'.$name;
    }
}
