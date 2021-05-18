<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\ReciboDet;
use App\Models\Tfachisa;
use App\Models\Tfacnda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RecibosController extends Controller
{
    //
    public function index()
    {
        $recibos = ReciboCab::where("created_by", auth()->user()->id)->get();

        return view('cobranzas.recibos.index', compact('recibos'));
    }

    public function edit($id)
    {
        $recibo = ReciboCab::find($id);
        dd($recibo->toArray());

        return view('cobranzas.recibos.edit', compact("recibo"));
    }

    public function create()
    {
        $dolares   = "100, 50, 20, 10, 5, 1, 0.5";
        $bolivares = "500000, 200000, 100000, 50000";
        $facturas  = Tfachisa::all();
        $notas     = Tfacnda::all();

        return view('cobranzas.recibos.create', compact('dolares', 'bolivares', 'facturas', 'notas'));
    }

    public function store(Request $request)
    {
//        dd($request->toArray());

        DB::beginTransaction();
        try {
            $reciboCab = new ReciboCab();

            $reciboCab->FECHA         = date("Y-m-d H:i:s");
            $reciboCab->TIPO_MONEDA   = $request->tipo_moneda;
            $reciboCab->TIPO_PAGO     = $request->tipo_pago;
            $reciboCab->TIPO_DOC      = $request->tipo_doc;
            $reciboCab->NUMEDOCU      = $request->nro_documento;
            $reciboCab->MONTO_DOC_VEF = Str::remove(",", $request->monto_doc_vef);
            $reciboCab->MONTO_DOC_USD = Str::remove(",", $request->monto_doc_usd);
            $reciboCab->TASA_CAMB     = Str::remove(",", $request->tasa_cambio);
            $reciboCab->VUELTO        = Str::remove(",", $request->vuelto);
            $reciboCab->SALDO_CLI     = Str::remove(",", $request->saldo_cli);

            $reciboCab->save();

            if ($request->tipo_pago == "T") {
                for ($i = 0; $i < count($request->tran_ref); $i++) {
                    $reciboDet = new ReciboDet();

                    $reciboDet->REFERENCIA = $request->tran_ref[$i];
                    $reciboDet->MONTO      = Str::remove(",", $request->tran_monto[$i]);

                    $reciboCab->reciboDet()->save($reciboDet);
                }
            } else if ($request->tipo_pago == "E") {
                for ($i = 0; $i < count($request->bill_cant); $i++) {
                    $reciboDet = new ReciboDet();

                    $reciboDet->CANTIDAD     = $request->bill_cant[$i];
                    $reciboDet->DENOMINACION = Str::remove(",", $request->bill_deno[$i]);

                    $reciboCab->reciboDet()->save($reciboDet);
                }
            }

            DB::commit();

            return response()->json([
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route("recibos.index")
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();

            return response()->json([
                'title' => "Atención.",
                "text"  => "Error en guardado del registro. Intente nuevamente.",
                "type"  => "error",
                "error" => $e->getMessage()
            ]);
        }
    }
}
