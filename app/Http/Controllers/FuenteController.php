<?php

namespace App\Http\Controllers;
use App\Models\Fuente; 
use App\Models\Geometria; 
use App\Models\Deposito; 
use App\Models\Tipo; 
use App\Models\Unidad;
use App\Models\Uso; 
use App\Models\Emision; 
use Barryvdh\DomPDF\Facade\Pdf; // Importa la Facade correctamente

use Illuminate\Http\Request;


class FuenteController extends Controller
{
    
    public function index()
{
    // Obtener todas las fuentes
    $fuentes = Fuente::all();

    // Total de fuentes activas
    $totalActivas = Fuente::where('Estado_Fuente', 'Act')->count();

    // Total de fuentes de baja
    $totalBajas = Fuente::where('Estado_Fuente', 'Baja')->count();

    // Total de fuentes que empiezan con A, B o C
    $totalA = Fuente::where('Id_Fuente_Radiactiva', 'like', 'A%')->count();
    $totalB = Fuente::where('Id_Fuente_Radiactiva', 'like', 'B%')->count();
    $totalC = Fuente::where('Id_Fuente_Radiactiva', 'like', 'C%')->count();

    // Pasar los datos a la vista
    return view('fuentes.index', compact('fuentes', 'totalActivas', 'totalBajas', 'totalA', 'totalB', 'totalC'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las geometr�as
        $geometrias = Geometria::all();
        $depositos = Deposito::all();
        $tipos = Tipo::all();
        $unidades = Unidad::all();
        $usos = Uso::all();
        $emisiones = Emision::all();

        // Pasar las geometr�as,depositos y tipos a la vista
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

    
    public function edit(string $id, Request $request)
{
        $fuente = Fuente::findOrFail($id);

        // Obtener todas las tablas adicionales
        $geometrias = Geometria::all();
        $depositos = Deposito::all();
        $tipos = Tipo::all();
        $unidades = Unidad::all();
        $usos = Uso::all();
        $emisiones = Emision::all();

        // Obtener el parámetro 'modo' para determinar si es edición o baja
        $modo = $request->input('modo', 'edicion'); // 'edicion' es el valor predeterminado

        // Pasar las variables y el modo a la vista
        return view('fuentes.edit', compact('fuente', 'geometrias', 'depositos', 'tipos', 'unidades', 'usos', 'emisiones', 'modo'));
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

    public function generarPDFPorFuente(Request $request)
{
    try {
        // Obtener el valor del filtro
        $letra = $request->input('filter');

        // Manejar el caso en que no se proporciona una letra
        if (empty($letra)) {
            return response()->json(['message' => 'La letra es requerida'], 400);
        }

        // Consultar las fuentes que comiencen con esa letra
        $fuentes = Fuente::where('Id_Fuente_Radiactiva', 'like', $letra . '%')->get();

        // Verificar si se encontraron fuentes
        if ($fuentes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron fuentes para la letra proporcionada.'], 404);
        }

        // Generar el PDF con la informaci�n
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reportes.fuentes_pdf', compact('fuentes', 'letra'));
        
        // Habilitar la carga remota de im�genes
        $pdf->set_option('isRemoteEnabled', true);

        // Renderizar el PDF
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Agregar n�mero de p�gina en el pie de p�gina
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(520, 820, "PÁgina {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        // Descargar el PDF
        return $pdf->download('fuentes_por_letra.pdf');
        
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al generar el PDF: ' . $e->getMessage()], 500);
    }
}

public function exportarCSV(Request $request)
    {
        try {
            $letra = $request->input('filter');

            if (empty($letra)) {
                return response()->json(['message' => 'La letra es requerida'], 400);
            }

            $fuentes = Fuente::where('Id_Fuente_Radiactiva', 'like', $letra . '%')->get();

            if ($fuentes->isEmpty()) {
                return response()->json(['message' => 'No se encontraron fuentes para la letra proporcionada.'], 404);
            }

            $filename = "fuentes_por_letra.csv";

            $callback = function() use ($fuentes) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['FUENTE', 'IDENTIFICACION', 'RADIO PRINCIPAL', 'Tipo_Emision_1', 'Actividad', 'Lugar de Depósito']);

                foreach ($fuentes as $fuente) {
                    fputcsv($file, [
                        $fuente->Id_Fuente_Radiactiva,
                        $fuente->Id_Fabricacion,
                        $fuente->Radionucleido_1,
                        $fuente->Tipo_Emision_1,
                        $fuente->Actividad_Inicial_1,
                        $fuente->Lugar_Deposito
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al generar el CSV: ' . $e->getMessage()], 500);
        }
    }

    // Bajas
public function generarPDFBajas(Request $request)
{
    try {
        // Filtrar las fuentes que tienen el estado 'BAJA'
        $fuentes = Fuente::where('Estado_Fuente', 'BAJA')->get();

        if ($fuentes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron fuentes con el estado BAJA.'], 404);
        }

        // Generar el PDF con la información
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reportes.fuentesBaja_pdf', compact('fuentes'));
        
        // Habilitar la carga remota de imágenes
        $pdf->setOptions(['isRemoteEnabled' => true]);

        // Renderizar el PDF
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Agregar número de página en el pie de página
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(520, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        // Descargar el PDF
        return $pdf->download('fuentes_de_baja.pdf');
        
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al generar el PDF: ' . $e->getMessage()], 500);
    }
}

public function exportarCSVBajas(Request $request)
    {
        try {
           
             // Filtrar las fuentes que tienen el estado 'BAJA'
        $fuentes = Fuente::where('Estado_Fuente', 'BAJA')->get();

        if ($fuentes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron fuentes con el estado BAJA.'], 404);
        }

            $filename = "fuentes_de_baja.csv";

            $callback = function() use ($fuentes) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['FUENTE', 'IDENTIFICACION', 'RADIO PRINCIPAL', 'TIPO RADIO', 'ACTIVIDAD', 'LUGAR/DEPOSITO']);

                foreach ($fuentes as $fuente) {
                    fputcsv($file, [
                        $fuente->Id_Fuente_Radiactiva,
                        $fuente->Id_Fabricacion,
                        $fuente->Radionucleido_1,
                        $fuente->Tipo_Emision_1,
                        $fuente->Actividad_Inicial_1,
                        $fuente->Lugar_Deposito
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al generar el CSV: ' . $e->getMessage()], 500);
        }
    }


  
}
