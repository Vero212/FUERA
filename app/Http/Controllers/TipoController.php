<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use Illuminate\Http\Request;


class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos =Tipo::all();
        return view('tipos.index',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tipos,nombre', 
            'desc' => 'nullable',
            'obs' => 'nullable',            

        ]);

        // Crear nuevo deposito
            Tipo::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activo' => $request->activo,
            ]);
        
        // Redirigir a la lista de geometr�as con un mensaje de �xito
            return redirect()->route('tipos.index')->with('success', 'Tipo agregado con Exito.');
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
        $tipo = Tipo::findOrFail($id);
        return view('tipos.edit', compact('tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tipos,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activo' => 'required|boolean',
        ]);
    
        // Actualizar deposito
        $tipos = Tipo::findOrFail($id);
        $tipos->update($request->all());
    
        // Redirigir a la lista con un mensaje de Ã©xito
        return redirect()->route('tipos.index')->with('success', 'Tipo actualizado con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
