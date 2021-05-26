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
                'recibos',
                'cliente'
            ])->find($id);
        } else {
            $data = Tfacnda::with([
                'recibos',
                'cliente'
            ])->find($id);
        }

//        $totalCobrado = 0;
//        foreach ($data->recibos as $item) {
//            $tasaCamb = $item->TASA_CAMB;
//            if ($item->TIPO_PAGO == "E") {
//                $montoRecibido = ReciboDet::where("id_recibo", "=", $item->id)->sum(DB::raw("CANTIDAD * DENOMINACION"));
//            }else{
//                $montoRecibido = ReciboDet::where("id_recibo", "=", $item->id)->sum("MONTO");
//            }
//            $totalCobrado += doubleval( ($item->TIPO_MONEDA == "VEF" && $tasaCamb > 0 && $montoRecibido > 0) ? $montoRecibido / $tasaCamb : $montoRecibido);
//        }
////        dd($totalCobrado);
//        $result = $data->toArray();
//        $result['total_cobrado'] = round($totalCobrado, 2);
//        dd($result);

        return response()->json($data);
    }
}
