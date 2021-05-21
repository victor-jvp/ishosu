<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\Relacion;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CobranzasController extends Controller
{
    //
    public function index()
    {
        return view("cobranzas.index", [
            "relaciones" => Relacion::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $relacion = new Relacion();

            $relacion->FECHA       = date("Y-m-d H:i:s");
            $relacion->TIPO_MONEDA = $request->tipo_moneda;
            $relacion->COMENTARIO  = $request->comentario;

            $relacion->save();

            $recibos = ReciboCab::where("tipo_moneda", $request->tipo_moneda)
                                ->whereNull("id_relacion")
                                ->where("created_by", auth()->user()->getAuthIdentifier())
                                ->get();

            foreach ($recibos as $recibo)
            {
                $recibo->id_relacion = $relacion->id;
                $recibo->save();
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

    public function show($id) {

        $relacion = Relacion::with("recibos")->find($id);

        return view("cobranzas.show", compact("relacion"));
    }

    public function print($id)
    {
        $relacion = Relacion::find($id);

        if($relacion->TIPO_MONEDA == "USD")
        {
            $pdf = PDF::loadView('cobranzas.reports.relacion_usd', compact("relacion"))->setPaper("Letter", "portrait");
            return $pdf->stream("Recibo {$relacion->idZero}.pdf");
//            return view("cobranzas.reports.$relacion_usd", compact("relacion", "billetes", "copies"));

        }else{
            $pdf = PDF::loadView('cobranzas.reports.relacion_vef', compact("relacion"))->setPaper("Letter", "landscape");
            return $pdf->stream("Recibo {$relacion->idZero}.pdf");
//            return view("cobranzas.reports.recibo_vef", compact("$relacion", "billetes", "copies"));
        }
    }
}
