<?php

namespace App\Http\Controllers;

use App\Support\NoticiaStore;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $tipo = $request->query('tipo');
        $items = NoticiaStore::byTipo($tipo);

        $perPage = 9;
        $page = max(1, (int) $request->query('page', 1));
        $slice = array_slice($items, ($page - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $slice,
            count($items),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('site.noticias.index', ['items' => $paginator, 'tipo' => $tipo]);
    }

    public function show(string $id)
    {
        $item = NoticiaStore::find($id);

        abort_if(! $item, 404);

        return view('site.noticias.show', compact('item'));
    }
}
