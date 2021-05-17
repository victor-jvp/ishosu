<?php

namespace App\Http\Controllers;

use App\Models\RelacionCab;
use Illuminate\Http\Request;

class CobranzasController extends Controller
{
    //
    public function index()
    {
        return view("cobranzas.index", [
            "relaciones" => RelacionCab::all()
        ]);
    }
}
