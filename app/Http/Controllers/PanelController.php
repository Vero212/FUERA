<?php

namespace App\Http\Controllers;
use App\Models\Fuente; 

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        // Obtener todas las fuentes
    $fuentes = Fuente::all();

    // Total de fuentes activas
    $totalActivas = Fuente::where('Estado_Fuente', 'Act')->count();

    // Total de fuentes de baja
    $totalBajas = Fuente::where('Estado_Fuente', 'Baja')->count();

    // Total de fuentes de estado Uso
    $totalUso = Fuente::where('Estado_Fuente', 'USO')->count();

    // Total de fuentes de estado No Calibradas
    $totalNoCalibrada = Fuente::where('Estado_Fuente', 'NO CALIBRADA')->count();

    // Sin estado definido (blanco o '(null)')
        $totalSinEstado = Fuente::where('Estado_Fuente', '')
        ->orWhere('Estado_Fuente', '(null)')
        ->count();

    // Total de fuentes que empiezan con A, B o C
    $totalA = Fuente::where('Id_Fuente_Radiactiva', 'like', 'A%')->count();
    $totalB = Fuente::where('Id_Fuente_Radiactiva', 'like', 'B%')->count();
    $totalC = Fuente::where('Id_Fuente_Radiactiva', 'like', 'C%')->count();

    $total=$totalActivas+$totalBajas+$totalSinEstado+$totalUso+$totalNoCalibrada;

    // Pasar los datos a la vista
    return view('panel', compact('fuentes', 'totalActivas', 'totalBajas','totalUso','totalNoCalibrada', 'totalA', 'totalB', 'totalC','totalSinEstado','total'));
    }
}