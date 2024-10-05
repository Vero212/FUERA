<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuente extends Model
{
    use HasFactory;
    protected $fillable=
    
    ['Id_Fuente_Radiactiva','Id_Fabricacion','Clasificacion','Fuente_Primaria_Origen','Tipo_Fuente','Geometria_Soporte','Dimensiones','Unidad_Actividad',
    'Radionucleido_1','Actividad_Inicial_1','Tipo_Emision_1','Semiperiodo_1_dias','Radionucleido_2','Actividad_Inicial_2','Tipo_Emision_2',
    'Semiperiodo_2_dias','Radionucleido_3','Actividad_Inicial_3','Tipo_Emision_3','Semiperiodo_3_dias','Radionucleido_4','Actividad_Inicial_4','Tipo_Emision_4',
    'Semiperiodo_4_dias','Radionucleido_5','Actividad_Inicial_5','Tipo_Emision_5','Semiperiodo_5_dias','Radionucleido_6','Actividad_Inicial_6','Tipo_Emision_6',
    'Semiperiodo_6_dias','Radionucleido_7','Actividad_Inicial_7','Tipo_Emision_7','Semiperiodo_7_dias','Radionucleido_8','Actividad_Inicial_8','Tipo_Emision_8',
    'Semiperiodo_8_dias','Radionucleido_9','Actividad_Inicial_9','Tipo_Emision_9','Semiperiodo_9_dias','Radionucleido_10','Actividad_Inicial_10','Tipo_Emision_10',
    'Semiperiodo_10_dias','Radionucleido_11','Actividad_Inicial_11','Tipo_Emision_11','Semiperiodo_11_dias','Radionucleido_12','Actividad_Inicial_12','Tipo_Emision_12',
    'Semiperiodo_12_dias',
    'Proveedor_Origen',
    'Uso_Origen',
    'Usuario_Principal',
    'Fecha_Referencia_1',
    'Fecha_Referencia_2',
    'Estado_Fuente',
    'Actividad_Corregida',
    'Fecha_Baja_Estimada',
    'Lugar_Deposito',
    'Estado',
    'Baja_Real',
    'Responsable',
    'Motivo_Baja',
    'Actividad_Calc',
    'Genera',
    'Modifica'];
}
