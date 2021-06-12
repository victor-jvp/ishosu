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
        if (!auth()->user()->can("relaciones.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        return view("cobranzas.index", [
            "relaciones" => Relacion::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (auth()->user()->hasRole(['Admin', 'Supervisor'])) {
                if (!$request->recibos) {
                    return response()->json([
                        'title' => "Atención.",
                        "text"  => "No hay recibos disponibles por relacionar.",
                        "type"  => "warning"
                    ]);
                }
                $recibos = ReciboCab::where("tipo_moneda", $request->tipo_moneda)
                    ->whereIn("id", $request->recibos)
                    ->get();
            } else {
                $recibos = ReciboCab::where("tipo_moneda", $request->tipo_moneda)
                    ->whereNull("id_relacion")
                    ->where("created_by", auth()->user()->getAuthIdentifier())
                    ->get();
                if (count($recibos) == 0) {
                    return response()->json([
                        'title' => "Atención.",
                        "text"  => "No hay recibos disponibles por relacionar.",
                        "type"  => "warning"
                    ]);
                }
            }

            $relacion = new Relacion();

            $relacion->FECHA       = date("Y-m-d H:i:s");
            $relacion->TIPO_MONEDA = $request->tipo_moneda;
            $relacion->COMENTARIO  = $request->comentario;

            $relacion->save();

            foreach ($recibos as $recibo) {
                $recibo->id_relacion = $relacion->id;
                $recibo->save();
            }

            DB::commit();

            return response()->json([
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route("cobranzas.show", $relacion->id)
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

    public function show($id)
    {
        if (!auth()->user()->can("relaciones.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $relacion = Relacion::with("recibos")->find($id);

        return view("cobranzas.show", compact("relacion"));
    }

    public function destroy($id)
    {
        if (!auth()->user()->can("relaciones.delete")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        try {
            DB::beginTransaction();

            // ReciboCab::where("id_relacion", $id)->update(["id_relacion" => NULL]);
            $relacion = Relacion::with('recibos')->find($id);
            $relacion->recibos()->update(["id_relacion" => null]);
            $relacion->delete();


            DB::commit();
            return response()->json([
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route("cobranzas.index")
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

    public function remove_recibo($id_recibo)
    {
        if (!auth()->user()->can("relaciones.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        try {
            DB::beginTransaction();

            $recibo              = ReciboCab::find($id_recibo);
            $id                  = $recibo->id_relacion;
            $recibo->id_relacion = null;
            $recibo->save();

            DB::commit();
            return response()->json([
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route("cobranzas.show", $id)
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

    public function print($id)
    {
        if (!auth()->user()->can("relaciones.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $relacion = Relacion::with('recibos.reciboDet')->find($id);
//        dd($relacion);

        $pdf = \App::make('dompdf.wrapper');
        /* Careful: use "enable_php" option only with local html & script tags you control.
  used with remote html or scripts is a major security problem (remote php injection) */
        $pdf->getDomPDF()->set_option("enable_php", true);

        if ($relacion->TIPO_MONEDA == "USD") {
            $pdf->loadView('cobranzas.reports.relacion_usd', compact("relacion"))->setPaper("Letter", "portrait");
            return $pdf->stream("Recibo {$relacion->idZero}.pdf");
            //            return view("cobranzas.reports.$relacion_usd", compact("relacion", "billetes", "copies"));

        } else {
            $pdf->loadView('cobranzas.reports.relacion_vef', compact("relacion"))->setPaper("Letter", "landscape");
            return $pdf->stream("Recibo {$relacion->idZero}.pdf");
            //            return view("cobranzas.reports.recibo_vef", compact("$relacion", "billetes", "copies"));
        }
    }
}
