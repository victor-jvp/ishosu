<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\Tcpce;
use App\Models\Tfacnda;
use App\Models\Tfachisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{
    public function ajaxSearchById(Request $request)
    {

        $id   = $request->get("id");
        $tipo = $request->get("tipo");
        $select = array(
            "NUMEDOCU",
            "NUMEDOCU AS text",
            "NUMEDOCU AS id",
            "FECHA",
            "CODICLIE",
            "CODIRUTA",
            "IMPUBRUT",
            "TOTADOCU",
            "DESCUENTOG",
            "TOTABRUT",
            "CAMBDOL",
            "IMPU1 AS IVA",
            "TIPODOCU"
        );

        $result = [];
        if ($tipo == "FA") {
            $result['results'] = Tfachisa::select($select)
                ->with(['recibos', 'cliente', 'ruta'])
                ->where("TIPODOCU", "=", "FA")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }
        if ($tipo == "NE") {
            $result['results'] = Tfacnda::select($select)
                ->with(['recibos', 'cliente', 'ruta'])
                ->where("TIPODOCU", "=", "NE")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }
        if ($tipo == "ND") {
            $result['results'] = Tcpce::select(
                    "NUMEDOCU",
                    "NUMEDOCU AS text",
                    "NUMEDOCU AS id",
                    "NUMEAFEC",
                    "TIPOAFEC",
                    "FECHA",
                    "CODICLIE",
                    "MONTNOTA AS TOTADOCU",
                    "EXENTO",
                    "IMPUESTO AS TOTABRUT",
                    "IMPU1 AS IVA",
                    "TIPODOCU"
                )->with(['recibos', 'cliente', 'faAfectada', 'neAfectada'])
                ->where("TIPODOCU", "=", "ND")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();
        }

        return response()->json($result);
    }
}
