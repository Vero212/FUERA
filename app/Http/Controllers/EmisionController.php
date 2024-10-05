<?php

namespace App\Http\Controllers;
use App\Models\Emision;
use Illuminate\Http\Request;


class EmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emisiones =Emision::all();
        return view('emisiones.index',compact('emisiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('emisiones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:emisiones,nombre', 
            'desc' => 'nullable',
            'obs' => 'nullable',            

        ]);

        // Crear nuevo deposito
            Emision::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activa' => $request->activa,
            ]);
                
            return redirect()->route('emisiones.index')->with('success', 'Emision agregada con Exito.');
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
        $emision = Emision::findOrFail($id);
        return view('emisiones.edit', compact('emision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:emisiones,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activa' => 'required|boolean',
        ]);
    
        // Actualizar unidad
        $emisiones = Emision::findOrFail($id);
        $emisiones->update($request->all());
            
        return redirect()->route('emisiones.index')->with('success', 'Emision actualizada con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}