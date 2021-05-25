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
            $data = Tfachisa::with(['recibos','cliente'])->find($id);
        }else{
            $data = Tfacnda::with(['recibos','cliente'])->find($id);
        }

        dd($data->toArray());
        // $totalCobrado = 0;
        // foreach ($data->recibos as $item)
        // {
        //     $tasaCamb = $item->TASA_CAMB;
        //     // dd($tasaCamb, $item->montoRecibido, $item->TIPO_MONEDA);
        //     $totalCobrado += ($item->TIPO_MONEDA == "VEF" && $tasaCamb > 0) ? $item->montoRecibido / $tasaCamb : $item->montoRecibido;
        // }

        // $data->totalCobrado = doubleval($totalCobrado);

        return response()->json($data);
    }
}
