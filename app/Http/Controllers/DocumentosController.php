<?php

namespace App\Http\Controllers;

use App\Models\Tcpce;
use App\Models\Tfacnda;
use App\Models\Tfachisa;
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

    public function ajaxSearchById(Request $request)
    {

        $id       = $request->get("id");
        $tipo = $request->get("tipo");

        $result = [];
        if ($tipo == "FA") {
            $result['results'] = Tfachisa::select("NUMEDOCU AS text", "NUMEDOCU AS id")
                ->where("TIPODOCU", "=", "FA")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }
        if ($tipo == "NE") {
            $result['results'] = Tfacnda::select("NUMEDOCU AS text", "NUMEDOCU AS id")
                ->where("TIPODOCU", "=", "NE")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }
        if ($tipo == "ND") {
            $result['results'] = Tcpce::select("NUMEDOCU AS text", "NUMEDOCU AS id")
                ->where("TIPODOCU", "=", "ND")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }

        return response()->json($result);
    }
}
