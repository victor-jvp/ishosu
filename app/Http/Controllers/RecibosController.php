<?php

namespace App\Http\Controllers;

use App\Models\BankE;
use App\Models\BankR;
use App\Models\Estacion;
use App\Models\ReciboCab;
use App\Models\ReciboDet;
use App\Models\Relacion;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RecibosController extends Controller
{
    //
    public function index()
    {
        if (!auth()->user()->can("recibos.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        if (auth()->user()->hasRole([
            "Admin",
            "Supervisor"
        ])) {
            $recibos = ReciboCab::whereNull("id_relacion")->get();
        } else {
            $recibos = ReciboCab::whereNull("id_relacion")->where("created_by", auth()->user()->getAuthIdentifier())->get();
        }

        return view('cobranzas.recibos.index', compact('recibos'));
    }

    public function show($id)
    {
        if (!auth()->user()->can("recibos.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $recibo = ReciboCab::find($id);
        return view("cobranzas.recibos.show", compact("recibo"));
    }

    public function create()
    {
        if (!auth()->user()->can("recibos.create")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $dolares   = "100, 50, 20, 10, 5, 1,Centimos...";
        $bolivares = "500000, 200000, 100000, 50000";
        $banks_e   = BankE::all();
        $banks_r   = BankR::all();

        return view('cobranzas.recibos.create', compact('dolares', 'bolivares', 'banks_e', 'banks_r'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $reciboCab = new ReciboCab();


            $reciboCab->estacion    = Auth::user()->estacion->codigo ?? "";
            $reciboCab->num         = (!is_null(Auth::user()->estacion)) ? (Auth::user()->estacion->recibo_num + 1) : ReciboCab::where("TIPO_DOC", $request->tipo_doc)->max("num") + 1;
            $reciboCab->FECHA       = date("Y-m-d H:i:s");
            $reciboCab->TIPO_MONEDA = $request->tipo_moneda;
            $reciboCab->TIPO_PAGO   = $request->tipo_pago;
            $reciboCab->TIPO_DOC    = $request->tipo_doc;
            $reciboCab->NUMEDOCU    = $request->nro_documento;
            $reciboCab->CODICLIE    = trim($request->id_cliente);
            $reciboCab->NOMBCLIE    = trim($request->cliente);
            $reciboCab->CODIRUTA    = trim($request->id_ruta);
            $reciboCab->NOMBVEND    = trim($request->vendedor);
            $reciboCab->TIPO_COBRO  = ($request->tipo_doc == "NE") ? "espec" : $request->tipo_cobro;
            $reciboCab->PORC        = ($request->tipo_cobro == "desc") ? Str::remove(",", $request->porcentaje) : 0;

            $reciboCab->MONTO_DESC = ($request->monto_desc != "") ? Str::remove(",", $request->monto_desc) : 0;
            $reciboCab->MONTO_DOC  = ($request->total_a_cobrar != "") ? Str::remove(",", $request->total_a_cobrar) : 0;
            $reciboCab->MONTO_RET  = ($request->monto_ret != "") ? Str::remove(",", $request->monto_ret) : 0;
            $reciboCab->TASA_CAMB  = ($request->tasa_cambio != "") ? Str::remove(",", $request->tasa_cambio) : 0;
            $reciboCab->VUELTO     = ($request->vuelto != "") ? Str::remove(",", $request->vuelto) : 0;
            $reciboCab->SALDO_DOC  = ($request->saldo_doc != "") ? Str::remove(",", $request->saldo_doc) : 0;
            $reciboCab->COMENTARIO = $request->comentario;

            $reciboCab->save();

            if ($request->tipo_pago == "T") {
                for ($i = 0; $i < count($request->tran_ref); $i++) {
                    $reciboDet = new ReciboDet();

                    $reciboDet->FECHA_PAGO = $request->tran_fecha[$i];
                    $reciboDet->REFERENCIA = $request->tran_ref[$i];
                    $reciboDet->bank_id_e  = $request->tran_bank_e[$i];
                    $reciboDet->bank_id_r  = $request->tran_bank_r[$i];
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

            Estacion::aumentarRecibo(Auth::user());

            DB::commit();

            $result = [
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route("recibos.index")
            ];
            if ($reciboCab->TIPO_PAGO == "E") {
                $result["print"] = route("recibos.print", $reciboCab->id);
            }
            return response()->json($result);

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

    public function edit($id)
    {
        if (!auth()->user()->can("recibos.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $recibo = ReciboCab::find($id);

        $dolares   = "100, 50, 20, 10, 5, 1,Centimos...";
        $bolivares = "500000, 200000, 100000, 50000";
        $banks_e   = Bank::whereIn("tipo", [
            "E",
            "A"
        ])->get();
        $banks_r   = Bank::whereIn("tipo", [
            "R",
            "A"
        ])->get();

        return view('cobranzas.recibos.edit', compact('recibo', 'dolares', 'bolivares', 'banks_e', 'banks_r'));
    }

    public function update()
    {

    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $recibo      = ReciboCab::find($id);
            $id_relacion = $recibo->id_relacion;
            $recibo->delete();

            if (!is_null($id_relacion)) {
                $relacion = Relacion::find($id_relacion);
                if ($relacion->recibos->count() == 0) {
                    $relacion->delete();
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

    public function print($id = null)
    {
        if (!auth()->user()->can("recibos.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $recibo = ReciboCab::find($id);

        if ($recibo->TIPO_MONEDA == "USD") {
            $billetes   = [
                100,
                50,
                20,
                10,
                5,
                1,
                0.5
            ];
            $paper_size = [
                0,
                0,
                612,
                396
            ];
            $pdf        = PDF::loadView('cobranzas.reports.recibo_usd', compact("recibo", "billetes"))->setPaper("letter", "portrait");
            return $pdf->stream("Recibo {$recibo->idZero}.pdf");
            //return view("cobranzas.reports.recibo_usd", compact("recibo", "billetes"));

        } else {
            $billetes   = [
                500000,
                200000,
                100000,
                50000
            ];
            $paper_size = [
                0,
                0,
                612,
                396
            ];
            $pdf        = PDF::loadView('cobranzas.reports.recibo_vef', compact("recibo", "billetes"))->setPaper("letter", "portrait");
            return $pdf->stream("Recibo {$recibo->idZero}.pdf");
//            return view("cobranzas.reports.recibo_vef", compact("recibo", "billetes"));
        }
    }

    public function marcar_vuelto($id)
    {
        try {
            DB::beginTransaction();

            $recibo             = ReciboCab::find($id);
            $recibo->VUELTO_ENT = true;
            $recibo->save();

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
