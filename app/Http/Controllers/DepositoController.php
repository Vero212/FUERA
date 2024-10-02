<?php

namespace App\Http\Controllers;
use App\Models\Deposito;
use Illuminate\Http\Request;


class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositos =Deposito::all();
        return view('depositos.index',compact('depositos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depositos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:depositos,nombre', // Aseg�rate de que la tabla sea correcta
            'desc' => 'nullable',
            'obs' => 'nullable',            

        ]);

        // Crear nuevo deposito
            Deposito::create([
                'nombre' => $request->nombre,
                'desc' => $request->desc, 
                'obs' => $request->obs,
                'activo' => $request->activo,
            ]);
        
        // Redirigir a la lista de geometr�as con un mensaje de �xito
            return redirect()->route('depositos.index')->with('success', 'Depósito agregado con éxito.');
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
        $deposito = Deposito::findOrFail($id);
        return view('depositos.edit', compact('deposito'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:depositos,nombre,' . $id,
            'desc' => 'nullable',
            'obs' => 'nullable',
            'activo' => 'required|boolean',
        ]);
    
        // Actualizar deposito
        $deposito = Deposito::findOrFail($id);
        $deposito->update($request->all());
    
        // Redirigir a la lista con un mensaje de Ã©xito
        return redirect()->route('depositos.index')->with('success', 'Depósito actualizado con Exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
