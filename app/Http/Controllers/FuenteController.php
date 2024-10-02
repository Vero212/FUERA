<?php

namespace App\Http\Controllers;
use App\Models\Fuente; // Importar el modelo Fuente
use App\Models\Geometria; // Importar el modelo Fuente
use App\Models\Deposito; // Importar el modelo Fuente

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

        // Pasar las geometrías y depositos a la vista
        return view('fuentes.create', compact('geometrias','depositos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Id_Fabricacion' => 'required|Id_Fabricacion|unique:fuentes',
            'Clasificacion' => 'required',
            'Fuente_Primaria_Origen' => 'required',
            'Tipo_Fuente' => 'required',
            'Geometria_Soporte' => 'required',
            'Dimensiones' => 'required',
            'Unidad_Actividad' => 'required'            

        ]);

        Fuente::create($request->all());
        return redirect()->route('fuentes.index');
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
