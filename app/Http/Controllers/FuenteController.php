<?php

namespace App\Http\Controllers;
use App\Models\Fuente; 
use App\Models\Geometria; 
use App\Models\Deposito; 
use App\Models\Tipo; 
use App\Models\Unidad;
use App\Models\Uso; 
use App\Models\Emision; 

use Illuminate\Http\Request;

class FuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuentes = Fuente::all();
        return view('fuentes.index',compact('fuentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las geometrías
        $geometrias = Geometria::all();
        $depositos = Deposito::all();
        $tipos = Tipo::all();
        $unidades = Unidad::all();
        $usos = Uso::all();
        $emisiones = Emision::all();

        // Pasar las geometrías,depositos y tipos a la vista
        return view('fuentes.create', compact('geometrias','depositos','tipos','unidades','usos','emisiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Id_Fuente_Radiactiva' => 'required|unique:fuentes,Id_Fuente_Radiactiva', 
            'Id_Fabricacion' => 'required|unique:fuentes,Id_Fabricacion', 
            'Clasificacion' => 'required',            
            'Tipo_Fuente' => 'required',                                    
            'Estado_Fuente' => 'required',


        ]);

        Fuente::create($request->all());
        return redirect()->route('fuentes.index')->with('success', 'Fuente creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fuente = Fuente::findOrFail($id);

        // Obtener todas las tablas adicionales

        $geometrias = Geometria::all();
        $depositos = Deposito::all();
        $tipos = Tipo::all();
        $unidades = Unidad::all();
        $usos = Uso::all();
        $emisiones = Emision::all();

        // Pasar las geometrías,depositos y tipos a la vista
        return view('fuentes.edit', compact('fuente','geometrias','depositos','tipos','unidades','usos','emisiones'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            /* 'nombre' => 'required|string|max:255|unique:emisiones,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activa' => 'required|boolean', */
        ]);
    
        // Actualizar unidad
        $fuentes = Fuente::findOrFail($id);
        $fuentes->update($request->all());
            
        return redirect()->route('fuentes.index')->with('success', 'Fuente actualizada con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
