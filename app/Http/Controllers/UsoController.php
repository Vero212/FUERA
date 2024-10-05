<?php

namespace App\Http\Controllers;
use App\Models\Uso;
use Illuminate\Http\Request;


class UsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usos =Uso::all();
        return view('usos.index',compact('usos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:usos,nombre', 
            'desc' => 'nullable',
            'obs' => 'nullable',            

        ]);

        // Crear nuevo deposito
            Uso::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activo' => $request->activo,
            ]);
                
            return redirect()->route('usos.index')->with('success', 'Uso agregado con Exito.');
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
        $uso = Uso::findOrFail($id);
        return view('usos.edit', compact('uso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:usos,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activo' => 'required|boolean',
        ]);
    
        // Actualizar unidad
        $usos = Uso::findOrFail($id);
        $usos->update($request->all());
            
        return redirect()->route('usos.index')->with('success', 'Uso actualizado con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}