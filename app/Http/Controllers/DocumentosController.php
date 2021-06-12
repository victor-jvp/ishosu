<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\Tcpce;
use App\Models\Tfacnda;
use App\Models\Tfachisa;
use App\Models\Truta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentosController extends Controller
{
    public function ajaxSearchById(Request $request)
    {
        $id   = trim($request->get("id"));
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
                ->with(['recibos', 'cliente'])
                ->where("TIPODOCU", "=", "FA")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();

            foreach ($result['results'] as $i => $row)
            {
                $result['results'][$i]['ruta'] = Truta::whereRaw("TRIM(CODIRUTA) = {$row['CODIRUTA']}")->first();
            }

            return $result;
        }
        if ($tipo == "NE") {

            $neOld = Tfacnda::select($select)
                ->with(['recibos', 'cliente'])
                ->where("TIPODOCU", "=", "NE")
                ->where("NUMEDOCU", "LIKE", "%{$id}%")
                ->orderby('NUMEDOCU', 'desc')
                ->get()->toArray();

            $neNew = Tfachisa::select($select)
                   ->with(['recibos', 'cliente'])
                   ->where("TIPODOCU", "=", "NE")
                   ->where("NUMEDOCU", "LIKE", "%{$id}%")
                   ->orderby('NUMEDOCU', 'desc')
                   ->get()->toArray();

            $result['results'] = array_merge($neOld, $neNew);

            foreach ($result['results'] as $i => $row)
            {
                $result['results'][$i]['ruta'] = Truta::whereRaw("TRIM(CODIRUTA) = {$row['CODIRUTA']}")->first();
            }

            return $result;
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
