<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$personas = DB::select("SELECT * FROM personas"); // SQL
        
        //Eloquent ORM
        $personas = Persona::all();

        return response()->json($personas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required  | min:3 | string ',
            'apellidos' => ' min:3 | string ',
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
}
