<style>
    .separador {
        border-right: 2px solid #5585ce; /* Cambia el color y grosor del borde según tu necesidad */
        padding-left: 10px; /* Añadir espacio para que el texto no quede pegado a la línea */
    }
    
    </style>
    
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Agregar Fuente') }}
            </h2>
        </x-slot>
    
        <div class="container py-3" style="width: 100%;max-width:1800px">
            <div class="card shadow-xl">
                <div class="card-body">
                    <form action="{{ route('fuentes.store') }}" method="POST">
                        @csrf
    
                        <div class="row">
                            <div class="col-md-2">
                                <label for="Id_Fuente_Radiactiva" class="form-label">Id Fuente:</label>
                                <input type="text" name="Id_Fuente_Radiactiva" id="Id_Fuente_Radiactiva" class="form-control" required>
                            </div>
    
                            <div class="col-md-2">
                                <label for="Tipo_Fuente" class="form-label">Tipo Fuente:</label>
                                <input type="text" name="Tipo_Fuente" id="Tipo_Fuente" class="form-control" required>
                            </div>
    
                            <div class="col-md-2">
                                <label for="Clasificacion" class="form-label">Clasificación:</label>
                                <input type="text" name="Clasificacion" id="Clasificacion" class="form-control" required>
                            </div>
    
                            <div class="col-md-2">
                                <label for="Geometria_Soporte" class="form-label">Geometría/Soporte:</label>
                                <input type="text" name="Geometria_Soporte" id="Geometria_Soporte" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Dimensiones" class="form-label">Dimensiones:</label>
                                <input type="text" name="Dimensiones" id="Dimensiones" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Estado_Fuente" class="form-label">Estado:</label>
                                <input type="text" name="Estado_Fuente" id="Estado_Fuenteo" class="form-control">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-2">
                                <label for="Fuente_Primaria_Origen" class="form-label">Fuente de Origen:</label>
                                <input type="text" name="Fuente_Primaria_Origen" id="Fuente_Primaria_Origen" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Unidad_Actividad" class="form-label">Unidad Activ:</label>
                                <input type="text" name="Unidad_Actividad" id="Unidad_Actividad" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Lugar_Deposito" class="form-label">Lugar /Despos:</label>
                                <input type="text" name="Lugar_Deposito" id="Lugar_Deposito" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Proveedor_Origen" class="form-label">Proveedor Origen:</label>
                                <input type="text" name="Proveedor_Origen" id="Proveedor_Origen" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Id_Fabricacion" class="form-label">Id Fabricación:</label>
                                <input type="text" name="Id_Fabricacion" id="Id_Fabricacion" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Uso_Origen" class="form-label">Uso Original:</label>
                                <input type="text" name="Uso_Origen" id="Uso_Origen" class="form-control">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-4">
                                <label for="Usuario_Principal" class="form-label">Usuario Principal:</label>
                                <input type="text" name="Usuario_Principal" id="Usuario_Principal" class="form-control">
                            </div>
    
                            <div class="col-md-4">
                                <label for="Fecha_Referencia_1" class="form-label">Fecha Ref 1:</label>
                                <input type="datetime" name="Fecha_Referencia_1" id="Fecha_Referencia_1" class="form-control">
                            </div>
    
                            <div class="col-md-4">
                                <label for="fecha_nacimiento" class="form-label">Fecha Baja Real:</label>
                                <input type="datetime" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                            </div>
                        </div>
    
                        <hr style="border: 1px solid #5585ce;"> <!-- Divisor para separar las secciones -->
    
                        <!--Parte de detalle -->
                        <div class="row">
                            @for ($i = 1; $i <= 12; $i++)
                                <div class="col-md-1">
                                    @if ($i <= 2) <!-- Mostrar los labels solo si $i es menor o igual a 2 -->
                                        <label for="radionucleido_{{ $i }}">Radionucleido</label>
                                    @endif
                                    <input type="text" class="form-control" id="radionucleido_{{ $i }}" name="detalle[{{ $i }}][radionucleido]">
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                        <label for="act_inicial_{{ $i }}">Act.Ini </label>
                                    @endif
                                    <input type="text" class="form-control" id="act_inicial_{{ $i }}" name="detalle[{{ $i }}][act_inicial]">
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                        <label for="actividad_{{ $i }}">Act</label>
                                    @endif
                                    <input type="text" class="form-control" id="actividad_{{ $i }}" name="detalle[{{ $i }}][actividad]">
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                        <label for="semiper_{{ $i }}">Semiper </label>
                                    @endif
                                    <input type="text" class="form-control" id="semiper_{{ $i }}" name="detalle[{{ $i }}][semiper]">
                                </div>
                        
                                <!-- Aquí, en la columna 6, aplicamos la clase 'separador' para agregar el borde -->
                                <div class="col-md-2 @if ($i==1 or $i==3 or $i==5 or $i==7 or $i== 9 or $i== 11) separador @endif">
                                    @if ($i <= 2)
                                        <label for="tipo_emision_{{ $i }}">Tipo Emisión</label>
                                    @endif
                                    <input type="text" class="form-control" id="tipo_emision_{{ $i }}" name="detalle[{{ $i }}][tipo_emision]">
                                </div>
                        
                                @if ($i % 6 == 0)
                                    <div class="w-100"></div> <!-- Salto de línea cada 6 campos -->
                                @endif
                            @endfor
                        </div>
    
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>