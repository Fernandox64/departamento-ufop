<?php

namespace App\Http\Controllers;

use App\Support\NoticiaStore;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->query('tipo');
        $items = NoticiaStore::byTipo($tipo);

        // A navegacao da listagem e por ano de publicacao (nao por numero de
        // pagina): os anos vem do conjunto ja filtrado por tipo, entao todo ano
        // oferecido tem pelo menos uma publicacao.
        $anos = NoticiaStore::anos($items);

        // Usa o ano pedido na URL apenas se ele existir de fato; senao cai no
        // mais recente (cobre link antigo, ano digitado a mao e troca de tipo
        // que deixa de ter aquele ano).
        $anoSelecionado = (int) $request->query('ano');
        if (! in_array($anoSelecionado, $anos, true)) {
            $anoSelecionado = $anos[0] ?? null;
        }

        $items = $anoSelecionado ? NoticiaStore::byAno($items, $anoSelecionado) : [];

        return view('site.noticias.index', compact('items', 'tipo', 'anos', 'anoSelecionado'));
    }

    public function show(string $id)
    {
        $item = NoticiaStore::find($id);

        abort_if(! $item, 404);

        return view('site.noticias.show', compact('item'));
    }
}
