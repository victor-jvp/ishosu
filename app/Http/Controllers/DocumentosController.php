<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Tfacnda;
use App\Models\Tfachisa;
use App\Models\ReciboCab;
use App\Models\ReciboDet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{
    //
    public function details(Request $request)
    {
        $data = [];

        $id       = $request->input("id");
        $tipo_doc = $request->input('tipo_doc');

        if ($tipo_doc == "FA") { // Si es Factura
            $data = Tfachisa::with([
                'recibos',
                'cliente',
                'ruta'
            ])->find($id);
        } else {
            $data = Tfacnda::with([
                'recibos',
                'cliente',
                'ruta'
            ])->find($id);
        }

        return response()->json($data);
    }

    public function ajaxSearchById()
    {

    }
}
