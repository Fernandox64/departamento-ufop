<?php

namespace App\Support;

class Assets
{
    /**
     * Devolve uma "versao" do arquivo em public/ para usar como ?v= nos links
     * de CSS/JS. Usa a data de modificacao do arquivo, entao muda sozinha a
     * cada alteracao e o navegador baixa a versao nova em vez de reaproveitar
     * a do cache.
     */
    public static function versao(string $caminhoRelativo): string
    {
        $caminho = public_path($caminhoRelativo);

        return file_exists($caminho) ? (string) filemtime($caminho) : '1';
    }
}
