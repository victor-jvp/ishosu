<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //

    public function index()
    {
        if (!auth()->user()->can("config.users.index")) {
           return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        return view("config.users.index", [
            "users" => User::where('username', '!=', 'admin')->get()
        ]);
    }

    public function create()
    {
        if (!auth()->user()->can("config.users.create")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        return view("config.users.create", [
            "roles" => Role::all(),
            "estaciones" => []
        ]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can("config.users.index")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        DB::beginTransaction();
        try {
            $user = new User();

            $user->name     = $request->name;
            $user->username = $request->username;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->roles()->sync($request->roles);

            DB::commit();
            $result = [
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route('config.users')
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
        if (!auth()->user()->can("config.users.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $user       = User::find($id);
        $roles      = Role::all();
        $estaciones = [];

        return view("config.users.edit", compact(
            "user",
            "roles",
            "estaciones"
        ));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can("config.users.update")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        DB::beginTransaction();
        try {
            $user = User::find($id);

            $user->name     = $request->name;
            $user->username = $request->username;
            $user->email    = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $user->roles()->sync($request->roles);

            DB::commit();
            $result = [
                'title' => "Aviso.",
                "text"  => "Se ha guardado el registro con éxito.",
                "type"  => "success",
                "goto"  => route('config.users')
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
        if (!auth()->user()->can("config.users.delete")) {
            return redirect()->route("home")->with("info", "Acceso denegado. No posee permisos para ir al sitio anterior.");
        }

        $user = User::find($id);
        if(is_null($user)) return redirect()->route('config.users.edit', $user)->with("info", "Ha ocurrido un problema al encontrar el usuario");

        //Validate if users has more than one record created
        $inRecords = $user->documentosCreatedBy->count() +
        $user->documentosUpdatedBy->count() +
        $user->relacionesCreatedBy->count() +
        $user->relacionesUpdatedBy->count();

        if ($inRecords > 0) { // if has more than one record delete it
            $user->delete();
        }else{ // if has no records then destroy it
            $user->forceDelete();
        }
        return redirect()->route('config.users.edit', $user)->with("info", "Usuario eliminado con exito");
    }
}
