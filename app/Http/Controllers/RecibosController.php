<?php

namespace App\Http\Controllers;

use App\Models\Tfachisa;
use App\Models\Tfacnda;
use Illuminate\Http\Request;

class RecibosController extends Controller
{
    //
    public function index($id = null)
    {
        return view('cobranzas.index',[
            'recibos' => []
        ]);
    }

    public function create()
    {
        $dolares   = "100, 50, 20, 10, 5, 1, 0.5";
        $bolivares = "500000, 200000, 100000, 50000";
        $facturas  = Tfachisa::all();
        $notas     = Tfacnda::all();

        return view('recibos.create', compact('dolares', 'bolivares', 'facturas', 'notas'));
    }

    public function store(Request $request)
    {
        dd($request->toArray());
    }
}
