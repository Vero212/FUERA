<?php

namespace App\Http\Controllers;
use App\Models\Geometria;
use Illuminate\Http\Request;


class GeometriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geometrias =Geometria::all();
        return view('geometrias.index',compact('geometrias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('geometrias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:geometrias,nombre', // Aseg�rate de que la tabla sea correcta
            'obs' => 'nullable',
        ]);

        // Crear nueva geometría
            Geometria::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activa' => $request->activa,
            ]);
        
        // Redirigir a la lista de geometr�as con un mensaje de �xito
            return redirect()->route('geometrias.index')->with('success', 'Geometría agregada con éxito.');
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
        $geometria = Geometria::findOrFail($id);
        return view('geometrias.edit', compact('geometria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:geometrias,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activa' => 'required|boolean',
        ]);
    
        // Actualizar la geometría
        $geometria = Geometria::findOrFail($id);
        $geometria->update($request->all());
    
        // Redirigir a la lista con un mensaje de éxito
        return redirect()->route('geometrias.index')->with('success', 'Geometría actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
