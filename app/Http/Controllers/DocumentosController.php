<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\ReciboDet;
use App\Models\Tfachisa;
use App\Models\Tfacnda;
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
                'recibos.reciboDet',
                'cliente'
            ])->find($id);
        } else {
            $data = Tfacnda::with([
                'recibos.reciboDet',
                'cliente'
            ])->find($id);
        }

        return response()->json($data);
    }
}
