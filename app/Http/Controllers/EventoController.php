<?php

namespace App\Http\Controllers;

use App\Support\EventoStore;

class EventoController extends Controller
{
    public function index()
    {
        $items = EventoStore::all();

        return view('site.eventos', compact('items'));
    }
}
