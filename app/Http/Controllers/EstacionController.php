<?php

namespace App\Http\Controllers;

use App\Models\Estacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EstacionController extends Controller
{
    //
    public function index()
    {
        if (!auth()->user()->can("config.estaciones.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        return view("config.estaciones.index", [
            "estaciones" => Estacion::all()
        ]);
    }

    public function create()
    {
        if (!auth()->user()->can("config.estaciones.create")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        return view("config.estaciones.create");
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can("config.estaciones.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        DB::beginTransaction();
        try {
            $estacion = new Estacion();

            $estacion->name   = $request->name;
            $estacion->codigo = $request->codigo;
            $estacion->save();

            DB::commit();
            $result = [
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route('config.estaciones.index')
            ];
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
        if (!auth()->user()->can("config.estaciones.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $estacion = Estacion::find($id);

        return view("config.estaciones.edit", compact(
            "estacion"
        ));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can("config.estaciones.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        DB::beginTransaction();
        try {
            $estacion = Estacion::find($id);

            $estacion->name   = $request->name;
            $estacion->codigo = $request->codigo;
            $estacion->save();

            DB::commit();
            $result = [
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route('config.estaciones.index')
            ];
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

    public function delete($id)
    {
        if (!auth()->user()->can("config.estaciones.delete")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $estacion = Estacion::find($id)->delete();

        return redirect()->route('config.estaciones.index')->with("info", "Registro eliminado con exito");
    }
}
