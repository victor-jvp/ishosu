<?php

namespace App\Http\Controllers;

use App\Models\ReciboCab;
use App\Models\Relacion;
use Illuminate\Http\Request;

class CobranzasController extends Controller
{
    //
    public function index()
    {
        return view("cobranzas.index", [
            "relaciones" => Relacion::all()
        ]);
    }

    public function create() {
        $recibos = ReciboCab::where("created_by", auth()->user()->id)->where("id_relacion", "=", NULL)->get();
        return view("cobranzas.create", compact("recibos"));
    }
}
