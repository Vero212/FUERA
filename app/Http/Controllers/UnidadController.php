<?php

namespace App\Http\Controllers;
use App\Models\Unidad;
use Illuminate\Http\Request;


class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades =Unidad::all();
        return view('unidades.index',compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:unidades,nombre', 
            'desc' => 'nullable',
            'obs' => 'nullable',            

        ]);

        // Crear nuevo deposito
            Unidad::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activo' => $request->activo,
            ]);
                
            return redirect()->route('unidades.index')->with('success', 'Unidad agregado con Exito.');
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
        $unidad = Unidad::findOrFail($id);
        return view('unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:unidades,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activo' => 'required|boolean',
        ]);
    
        // Actualizar unidad
        $unidades = Unidad::findOrFail($id);
        $unidades->update($request->all());
            
        return redirect()->route('unidades.index')->with('success', 'Unidad actualizado con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
