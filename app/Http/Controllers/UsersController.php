<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    //

    public function index()
    {
        return view("config.users.index", [
            "usuarios" => User::all()
        ]);
    }

    public function create()
    {
        $roles = Role::all();

        return view("config.users.create", compact('roles'));
    }

    public function store(Request $request)
    {
        dd($request);
        $user = new User();

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('config.users.edit', $user)->with("info", "Usuario creado con exito");
    }

    public function edit()
    {
        $roles = Role::all();

        return view("config.users.create", compact('roles'));
    }

}
