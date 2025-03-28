<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$personas = DB::select("SELECT * FROM personas"); // SQL

        //Eloquent ORM
        $personas = Persona::with(['user'])->orderBy('id', 'desc')->get();

        return response()->json($personas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required  | min:3 | max:30 ',
            'apellidos' => ' string  | min:3 | max:50 ',
        ]);

        $nombres = $request->nombres;
        $apellidos = $request->apellidos;

        // DB::insert("INSERT INTO personas (nombres, apellidos) VALUES (?, ?)", [$nombres, $apellidos]); // SQL 

        // DB::table('personas')->insert(['nombres' => $nombres, 'apellidos' => $apellidos,]); // Query Builder

        // Eloquent ORM
        $personas = new Persona();
        $personas->nombres = $nombres;
        $personas->apellidos = $apellidos;
        $personas->save();

        return response()->json(["Mensaje" => "Persona Registrada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function funGuardarPersonaUser(Request $request)
    {
        //Validar los datos personales y el usuario
        $request->validate([
            'nombres' => 'required|min:2|max:30',
            'apellidos' => 'required|min:2|max:50',
            'email' => 'required|email | unique:users',
            'password' => 'required | min:8 | string',
        ]);

        DB::beginTransaction();

        try {
            //guardar user
            $u = new User();
            $u->name = $request->nombres;
            $u->email = $request->email;
            $u->password = Hash::make($request->password);
            $u->save();

            //guardar persona
            $p = new Persona();
            $p->nombres = $request->nombres;
            $p->apellidos = $request->apellidos;
            $p->user_id = $u->id;
            $p->save();
            DB::commit();
            return response()->json(["mensaje" => "Persona registrada correctamente"], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["mensaje" => "Error al registrar persona", "error" => $e->getMessage()], 400);
        }
    }

    public function funAddUserPersona(Request $request, $id)
    {

        $request->validate([
            'email' => 'required|email | unique:users',
            'password' => 'required | min:8 | string',
        ]);
        DB::beginTransaction();

        try {

            $persona = Persona::find($id);

            $u = new User();
            $u->name = $persona->nombres;
            $u->email = $request->email;
            $u->password = Hash::make($request->password);
            $u->save();

            $persona->user_id = $u->id;
            $persona->update();

            DB::commit();
            return response()->json(["mensaje" => "Usuario asignado a persona"], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(["mensaje" => "Error al registrar persona", "error" => $e->getMessage()], 400);
        }
    }
}
