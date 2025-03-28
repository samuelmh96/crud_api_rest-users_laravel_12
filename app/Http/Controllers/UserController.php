<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function funListar()
    {
        //SQL
        // $usuarios = DB::select("SELECT * FROM users");
        //Query Builder
        //$usuarios = DB::table('users')->get();
        //Eloquent
        $usuarios = User::all();
        return $usuarios;
    }

    public function funGuardar(Request $request)
    {
        $request->validate([
            'name' => 'required | min:3 | string',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8 | string'
        ]);

        try {
            // DB::beginTransaction();// solo se usa cuando involucra mas de una tabla
            $nombre = $request->name;
            $correo = $request->email;
            $password = $request->password;

            $usuario = new User();
            $usuario->name = $nombre;
            $usuario->email = $correo;
            $usuario->password = $password;
            $usuario->save();

            DB::commit();
            return response()->json(["Mensaje" => "Usuario Registrado"], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["Mensaje" => "Error al registrar usuario", "Error" => $e->getMessage()], 500);
        }
    }

    public function funMostrar($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json($usuario, 200);
    }

    public function funModificar(Request $request, $id)
    {
        $nombre = $request->name;
        $correo = $request->email;
        $password = $request->password;

        $usuario = User::findOrFail($id);
        $usuario->name = $nombre;
        $usuario->email = $correo;
        $usuario->password = $password;
        $usuario->update();

        return response()->json(["Mensaje" => "Usuario Modificado"], 200);
    }

    public function funEliminar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return response()->json(["Mensaje" => "Usuario Eliminado"], 200);
    }
}
