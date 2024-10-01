<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuentes', function (Blueprint $table) {
            $table->id();


            //$table->string('Id_Fuente_Radiactiva');
            $table->string('Id_Fabricacion');
            $table->string('Clasificacion');
            $table->string('Fuente_Primaria_Origen');
            $table->string('Tipo_Fuente');
            $table->string('Geometria_Soporte');
            $table->string('Dimensiones');
            $table->string('Unidad_Actividad');

            $table->string('Radionucleido_1');
            $table->float('Actividad_Inicial_1');
            $table->string('Tipo_Emision_1');
            $table->string('Semiperiodo_1_dias');

            $table->string('Radionucleido_2');
            $table->float('Actividad_Inicial_2');
            $table->string('Tipo_Emision_2');
            $table->string('Semiperiodo_2_dias');

            $table->string('Radionucleido_3');
            $table->float('Actividad_Inicial_3');
            $table->string('Tipo_Emision_3');
            $table->string('Semiperiodo_3_dias');

            $table->string('Radionucleido_4');
            $table->float('Actividad_Inicial_4');
            $table->string('Tipo_Emision_4');
            $table->string('Semiperiodo_4_dias');

            $table->string('Radionucleido_5');
            $table->float('Actividad_Inicial_5');
            $table->string('Tipo_Emision_5');
            $table->string('Semiperiodo_5_dias');

            $table->string('Radionucleido_6');
            $table->float('Actividad_Inicial_6');
            $table->string('Tipo_Emision_6');
            $table->string('Semiperiodo_6_dias');

            $table->string('Radionucleido_7');
            $table->float('Actividad_Inicial_7');
            $table->string('Tipo_Emision_7');
            $table->string('Semiperiodo_7_dias');

            $table->string('Radionucleido_8');
            $table->float('Actividad_Inicial_8');
            $table->string('Tipo_Emision_8');
            $table->string('Semiperiodo_8_dias');

            $table->string('Radionucleido_9');
            $table->float('Actividad_Inicial_9');
            $table->string('Tipo_Emision_9');
            $table->string('Semiperiodo_9_dias');

            $table->string('Radionucleido_10');
            $table->float('Actividad_Inicial_10');
            $table->string('Tipo_Emision_10');
            $table->string('Semiperiodo_10_dias');

            $table->string('Radionucleido_11');
            $table->float('Actividad_Inicial_11');
            $table->string('Tipo_Emision_11');
            $table->string('Semiperiodo_11_dias');

            $table->string('Radionucleido_12');
            $table->float('Actividad_Inicial_12');
            $table->string('Tipo_Emision_12');
            $table->string('Semiperiodo_12_dias');

            $table->string('Proveedor_Origen');
            $table->string('Uso_Origen');
            $table->string('Usuario_Principal');
            $table->date('Fecha_Referencia_1');
            $table->date('Fecha_Referencia_2');
            $table->string('Estado_Fuente');

            $table->BigInteger('Actividad_Corregida');
            $table->datetime('Fecha_Baja_Estimada');
            $table->string('Lugar_Deposito');
            $table->string('Estado',2);
            $table->datetime('Baja_Real');
            $table->smallInteger('Responsable');
            $table->string('Motivo_Baja');
            $table->string('Actividad_Calc');
            $table->smallInteger('Genera');
            $table->smallInteger('Modifica');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuentes');
    }
};
