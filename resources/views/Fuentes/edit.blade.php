<style>
    .label-negrita{
        font-weight: bold;    
    }
</style>

<style>
    .separador {
        border-right: 2px solid #5585ce; /* Cambia el color y grosor del borde segÃºn tu necesidad */
        padding-left: 10px; /* AÃ±adir espacio para que el texto no quede pegado a la lÃ­nea */
        padding-right: 10px !important; /* AÃ±adir espacio para que el texto no quede pegado a la lÃ­nea */
        box-sizing: border-box; /* Asegura que los paddings y borders estÃ©n incluidos en el ancho */
    }

  .row .col-md-1 {
    padding-left: 2px; /* Ajusta este valor segï¿½n el espacio que desees */
    padding-right: 2px; /* Ajusta este valor segï¿½n el espacio que desees */
    }


    .label-negrita{
        font-weight: bold;
    }
 
    
</style>    
<x-app-layout>
    <x-slot name="header">
        @if ($modo === 'edicion')
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Fuente') }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Baja de Fuente') }}
            </h2>
        @endif
    </x-slot>

        {{-- {{ dd($fuente) }} --}}        
        <div class="container py-3" style="width: 100%;max-width:1600px">
            <div class="card shadow-xl">
                <div class="card-body">
                        <!-- Mensajes de error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    
                        <form action="{{ route('fuentes.update', $fuente->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Usamos PUT para la actualizaci�n -->
                            
                        {{-- COMPORTAMIENTO PARA EDICION --}}
                            @if($modo === 'edicion')
                            {{-- Primer Bloque de Datos Cabecera --}}
                            <div class="row">
                                <div class="col-md-1">
                                    <label for="Id_Fuente_Radiactiva" class="label-negrita">Id Fuente:</label>
                                    <input type="text" name="Id_Fuente_Radiactiva" class="form-control"  
                                        value="{{ old('Id_Fuente_Radiactiva', $fuente->Id_Fuente_Radiactiva) }}" required>                                    
                                </div>
                                                                                                            
                                <div class="col-md-2">
                                    <label for="Tipo_Fuente" class="label-negrita">Tipo Fuente:</label>
                                    <select name="Tipo_Fuente" id="Tipo_Fuente" class="form-control">
                                        <option value="">Seleccione un tipo</option>
                                        @foreach($tipos as $tipo)                                        
                                            <option value="{{ $tipo->nombre }}" {{ old('Tipo_Fuente', $fuente->Tipo_Fuente) == $tipo->nombre ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="col-md-2">
                                        <label for="Clasificacion" class="label-negrita">Clasificación:</label>
                                        <select name="Clasificacion" id="Clasificacion" class="form-control">
                                            <option value="">Seleccione un estado</option>
                                            <option value="PRIMARIA" {{ old('Clasificacion', $fuente->Clasificacion) == 'PRIMARIA' ? 'selected' : '' }}>PRIMARIA</option>
                                            <option value="SECUNDARIA" {{ old('Clasificacion', $fuente->Clasificacion) == 'SECUNDARIA' ? 'selected' : '' }}>SECUNDARIA</option>
                                            <option value="TERCIARIA" {{ old('Clasificacion', $fuente->Clasificacion) == 'TERCIARIA' ? 'selected' : '' }}>TERCIARIA</option>
                                            <option value="STD INTERNO" {{ old('Clasificacion', $fuente->Clasificacion) == 'STD INTERNO' ? 'selected' : '' }}>STD INTERNO</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="Geometria_Soporte" class="label-negrita">Geometría/Soporte:</label>
                                        <select name="Geometria_Soporte" id="Geometria_Soporte" class="form-control">
                                            <option value="">Seleccione una geometría</option>
                                            @foreach($geometrias as $geometria)                                        
                                                <option value="{{ $geometria->nombre }}" {{ old('Geometria_Soporte', $fuente->Geometria_Soporte) == $geometria->nombre ? 'selected' : '' }}>
                                                    {{ $geometria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                <div class="col-md-2">
                                    <label for="Dimensiones" class="label-negrita">Dimensiones:</label>                                    
                                    <input type="text" name="Dimensiones" class="form-control"  
                                        value="{{ old('Dimensiones', $fuente->Dimensiones) }}">  
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="Estado_Fuente" class="label-negrita">Estado:</label>
                                    <select name="Estado_Fuente" id="Estado_Fuente" class="form-control">
                                        <option value="">Seleccione un estado</option>
                                        <option value="ACT" {{ old('Estado_Fuente', $fuente->Estado_Fuente) == 'ACT' ? 'selected' : '' }}>ACT</option>
                                        <option value="BAJA" {{ old('Estado_Fuente', $fuente->Estado_Fuente) == 'BAJA' ? 'selected' : '' }}>BAJA</option>
                                        <option value="NO CALIBRADA" {{ old('Estado_Fuente', $fuente->Estado_Fuente) == 'NO CALIBRADA' ? 'selected' : '' }}>NO CALIBRADA</option>
                                        <option value="USO" {{ old('Estado_Fuente', $fuente->Estado_Fuente) == 'USO' ? 'selected' : '' }}>USO</option>
                                    </select>
                                </div>
                                <br><br><br><br>
                            </div>
                                {{-- Segundo Bloque de Datos Cabecera --}}

                            <div class="row">
                                    <div class="col-md-1">
                                        <label for="Fuente_Primaria_Origen" class="label-negrita">Origen:</label>
                                        <input type="text" name="Fuente_Primaria_Origen" class="form-control"  
                                        value="{{ old('Fuente_Primaria_Origen', $fuente->Fuente_Primaria_Origen) }}"> 
                                    </div>                            
                                           
                                    <div class="col-md-2">
                                        <label for="Unidad_Actividad" class="label-negrita">Unidad Activ:</label>
                                        <select name="Unidad_Actividad" id="Unidad_Actividad" class="form-control">
                                            <option value="">Seleccione una unidad</option>
                                            @foreach($unidades as $unidad)                                        
                                                <option value="{{ $unidad->nombre }}" {{ old('Unidad_Actividad', $unidad->nombre) == $unidad->nombre ? 'selected' : '' }}>
                                                    {{ $unidad->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <label for="Lugar_Deposito" class="label-negrita">Lugar/Depósito:</label>
                                        <select name="Lugar_Deposito" id="Lugar_Deposito" class="form-control">
                                            <option value="">Seleccione un depósito</option>
                                            @foreach($depositos as $deposito)                                        
                                                <option value="{{ $deposito->id }}" {{ old('Lugar_Deposito', $deposito->nombre) == $deposito->nombre ? 'selected' : '' }}>
                                                    {{ $deposito->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="Uso_Origen" class="label-negrita">Uso Original:</label>
                                        <select name="Uso_Origen" id="Uso_Origen" class="form-control">
                                            <option value="">Seleccione un uso</option>
                                            @foreach($usos as $uso)                                        
                                                <option value="{{ $uso->id }}" {{ old('Uso_Origen', $uso->nombre) == $uso->nombre ? 'selected' : '' }}>
                                                    {{ $uso->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="col-md-2">
                                        <label for="Proveedor_Origen" class="label-negrita">Proveedor Origen:</label>                                        
                                        <input type="text" name="Proveedor_Origen" class="form-control"  
                                            value="{{ old('Proveedor_Origen', $fuente->Proveedor_Origen) }}"> 
                                    </div>
            
                                    <div class="col-md-2">
                                        <label for="Id_Fabricacion" class="label-negrita">Id Fabricación:</label>
                                        <input type="text" name="Id_Fabricacion" class="form-control"
                                            value="{{ old('Id_Fabricacion', $fuente->Id_Fabricacion) }}">
                                    </div>                                                                
                            </div>
                                <br>

                                {{-- Tercer Bloque de Datos Cabecera --}}
                            <div class="row">
                                    <div class="col-md-4">
                                        <label for="Usuario_Principal" class="label-negrita">Usuario Principal:</label>
                                        <input type="text" name="Usuario_Principal" class="form-control"
                                        value="{{ old('Usuario_Principal', $fuente->Usuario_Principal) }}">
                                    </div>
            
                                    <div class="col-md-2">
                                        <label for="Fecha_Referencia_1" class="label-negrita">Fecha Ref 1:</label>
                                        <input type="datetime-local" name="Fecha_Referencia_1" class="form-control"
                                            value="{{ old('Fecha_Referencia_1', $fuente->Fecha_Referencia_1) }}">
                                    </div>
            
                                    <div class="col-md-2">
                                        <label for="Baja_Real" class="label-negrita">Fecha Baja Real:</label>
                                        <input type="datetime-local" name="Baja_Real" class="form-control"
                                            value="{{ old('Baja_Real', $fuente->Baja_Real) }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="Motivo_Baja" class="label-negrita">Motivo de Baja:</label>
                                        <select name="Motivo_Baja" id="Motivo_Baja" class="form-control">
                                            <option value="">Seleccione un motivo</option>
                                            <option value="Consumo" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Consumo' ? 'selected' : '' }}>Consumo</option>
                                            <option value="Decaimiento" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Decaimiento' ? 'selected' : '' }}>Decaimiento</option>
                                            <option value="Deterioro" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Deterioro' ? 'selected' : '' }}>Deterioro</option>
                                            <option value="Fraccionamiento" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Fraccionamiento' ? 'selected' : '' }}>Fraccionamiento</option>
                                        </select>
                                    </div>
                            </div>
  
                            <hr style="border: 1px solid #5585ce;"> <!-- Divisor para separar las secciones -->
    
                            <!-- Parte de detalle Radionucleidos -->
                                <div class="row g-1">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <div class="col-md-1 ">
                                            @if ($i <= 2) <!-- Mostrar los labels solo si $i es menor o igual a 2 -->
                                                <label for="radionucleido_{{ $i }}" class="label-negrita">Radionucleido</label>
                                            @endif
                                            <select class="form-control" id="radionucleido_{{ $i }}" name="Radionucleido_{{ $i }}">
                                                <option value="">Seleccione</option>
                                                @foreach (['Am/Be', 'Am241', 'Am243', 'Ba133', 'Bi207', 'BLANCO', 'C14', 'Ce144', 'C136', 'Cm244', 'Co57', 'Co60', 'Cr51', 'Cs134',
                                                            'Cs137', 'Eu152', 'Fe59', 'H3', 'Ho166', 'I131', 'Ir192', 'Kr85', 'Mn54', 'Po210', 'Pu239', 'Pu242', 'Ru103', 'Ru106', 'Sb125',
                                                            'Sr89', 'Sr90', 'Sr90/Y90', 'T1204', 'U233', 'Uranio Enriq'] as $option)
                                                    <option value="{{ $option }}" {{ (strtolower(old("Radionucleido_{$i}", $fuente->{'Radionucleido_' . $i})) ) == strtolower($option) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            @if ($i <= 2)
                                                <label for="Actividad_inicial_{{ $i }}" class="label-negrita">Act.Ini </label>
                                            @endif
                                            <input type="text" class="form-control" id="Actividad_inicial_{{ $i }}" name="Actividad_Inicial_{{ $i }}"
                                                value="{{ old("Actividad_Inicial_{$i}", $fuente->{'Actividad_Inicial_' . $i} ?? '') }}">
                                        </div>

                                        <div class="col-md-1">
                                            @if ($i <= 2)
                                                <label for="Actividad_{{ $i }}" class="label-negrita">Actividad </label>
                                            @endif
                                                <input type="text" class="form-control" id="Actividad_{{ $i }}" name="Actividad_{{ $i }}"
                                                    value="{{ old("Actividad_{$i}", $fuente->{'Actividad_' . $i} ?? '') }}">
                                        </div>
                                        
                                        <div class="col-md-1">
                                                @if ($i <= 2)
                                                    <label for="semiper_{{ $i }}" class="label-negrita">Semiper </label>
                                                @endif
                                                <input type="text" class="form-control" id="semiper_{{ $i }}" name="Semiperiodo_{{ $i }}_dias"
                                                    value="{{ old("Semiperiodo_{$i}_dias", $fuente->{'Semiperiodo_' . $i . '_dias'} ?? '') }}">
                                        </div>

                                        <div class="col-md-2 @if ($i==1 or $i==3 or $i==5 or $i==7 or $i== 9 or $i== 11) separador @endif">
                                            @if ($i <= 2)
                                                <label for="Tipo_Emision_{{ $i }}" class="label-negrita">Tipo Emisión</label>
                                            @endif
                                            
                                            <select name="Tipo_Emision_{{ $i }}" id="Tipo_Emision_{{ $i }}" class="form-control">
                                                <option value="">Seleccione</option>
                                                @foreach($emisiones as $emision)
                                                    <option value="{{ $emision->nombre }}" {{ old("Tipo_Emision_{$i}", $fuente->{'Tipo_Emision_' . $i} ?? '') == $emision->nombre ? 'selected' : '' }}>
                                                        {{ $emision->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>                                                                
                                        </div>

                                        @if ($i % 6 == 0)
                                            <div class="w-100"></div> <!-- Salto de línea cada 6 campos -->
                                        @endif
                                    @endfor
                                </div>
                        @else

                         {{-- COMPORTAMIENTO DE LA VISTA PARA BAJAS --}}
                         <div class="row">
                            <div class="col-md-1">
                                <label for="Id_Fuente_Radiactiva" class="label-negrita">Id Fuente:</label>
                                <input type="text" name="Id_Fuente_Radiactiva" class="form-control"  
                                    value="{{ old('Id_Fuente_Radiactiva', $fuente->Id_Fuente_Radiactiva) }}" readonly>                                    
                            </div>
                                                                                                        
                            <div class="col-md-2">
                                <label for="Tipo_Fuente" class="label-negrita">Tipo Fuente:</label>
                                <input type="text" name="Tipo_Fuente" class="form-control"  
                                    value="{{ old('Tipo_Fuente', $fuente->Tipo_Fuente) }}" readonly>                                 
                            </div>

                                <div class="col-md-2">
                                    <label for="Clasificacion" class="label-negrita">Clasificación:</label>
                                    <input type="text" name="Clasificacion" class="form-control"  
                                    value="{{ old('Clasificacion', $fuente->Clasificacion) }}" readonly>                                        
                                </div>

                                <div class="col-md-3">
                                    <label for="Geometria_Soporte" class="label-negrita">Geometría/Soporte:</label>
                                    <input type="text" name="Gometria_Soporte" class="form-control"  
                                    value="{{ old('Geometria_Soporte', $fuente->Geometria_Soporte) }}" readonly>                                     
                                </div>
    
                            <div class="col-md-2">
                                <label for="Dimensiones" class="label-negrita">Dimensiones:</label>                                    
                                <input type="text" name="Dimensiones" class="form-control"  
                                    value="{{ old('Dimensiones', $fuente->Dimensiones) }}" readonly>  
                            </div>
                            
                            <div class="col-md-2">
                                <label for="Estado_Fuente" class="label-negrita">Estado:</label>
                                <input type="text" name="Estado_Fuente" class="form-control"  
                                    value="BAJA" readonly>                                      
                            </div>
                            <br><br><br><br>
                        </div>
                            {{-- Segundo Bloque de Datos Cabecera --}}

                        <div class="row">
                                <div class="col-md-1">
                                    <label for="Fuente_Primaria_Origen" class="label-negrita">Origen:</label>
                                    <input type="text" name="Fuente_Primaria_Origen" class="form-control"  
                                    value="{{ old('Fuente_Primaria_Origen', $fuente->Fuente_Primaria_Origen) }}" readonly> 
                                </div>                            
                                       
                                <div class="col-md-2">
                                    <label for="Unidad_Actividad" class="label-negrita">Unidad Activ:</label>
                                    <input type="text" name="Unidad_Actividad" class="form-control"  
                                    value="{{ old('Unidad_Actividad', $fuente->Unidad_Actividad) }}" readonly>                                    
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="Lugar_Deposito" class="label-negrita">Lugar/Depósito:</label>
                                    <input type="text" name="Lugar_Deposito" class="form-control"  
                                    value="{{ old('Lugar_Deposito', $fuente->Lugar_Deposito) }}" readonly>                                    
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="Uso_Origen" class="label-negrita">Uso Original:</label>
                                    <input type="text" name="Uso_Origen" class="form-control"  
                                    value="{{ old('Uso_Origen', $fuente->Uso_Origen) }}" readonly>                                    
                                </div>
        
                                <div class="col-md-2">
                                    <label for="Proveedor_Origen" class="label-negrita">Proveedor Origen:</label>                                        
                                    <input type="text" name="Proveedor_Origen" class="form-control"  
                                        value="{{ old('Proveedor_Origen', $fuente->Proveedor_Origen) }}" readonly> 
                                </div>
        
                                <div class="col-md-2">
                                    <label for="Id_Fabricacion" class="label-negrita">Id Fabricación:</label>
                                    <input type="text" name="Id_Fabricacion" class="form-control"
                                        value="{{ old('Id_Fabricacion', $fuente->Id_Fabricacion) }}" readonly>
                                </div>                                                                
                        </div>
                            <br>

                            {{-- Tercer Bloque de Datos Cabecera --}}
                        <div class="row">
                                <div class="col-md-4">
                                    <label for="Usuario_Principal" class="label-negrita">Usuario Principal:</label>
                                    <input type="text" name="Usuario_Principal" class="form-control"
                                    value="{{ old('Usuario_Principal', $fuente->Usuario_Principal) }}" readonly>
                                </div>
        
                                <div class="col-md-2">
                                    <label for="Fecha_Referencia_1" class="label-negrita">Fecha Ref 1:</label>
                                    <input type="datetime" name="Fecha_Referencia_1" class="form-control"
                                        value="{{ old('Fecha_Referencia_1', $fuente->Fecha_Referencia_1) }}" readonly>
                                </div>
        
                                <div class="col-md-2">
                                    <label for="Baja_Real" class="label-negrita">Fecha Baja Real:</label>
                                    <input type="datetime-local" name="Baja_Real" class="form-control"
                                        value="{{ old('Baja_Real', $fuente->Baja_Real) }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="Motivo_Baja" class="label-negrita">Motivo de Baja:</label>
                                    <select name="Motivo_Baja" id="Motivo_Baja" class="form-control">
                                        <option value="">Seleccione un motivo</option>
                                        <option value="Consumo" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Consumo' ? 'selected' : '' }}>Consumo</option>
                                        <option value="Decaimiento" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Decaimiento' ? 'selected' : '' }}>Decaimiento</option>
                                        <option value="Deterioro" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Deterioro' ? 'selected' : '' }}>Deterioro</option>
                                        <option value="Fraccionamiento" {{ old('Motivo_Baja', $fuente->Motivo_Baja) == 'Fraccionamiento' ? 'selected' : '' }}>Fraccionamiento</option>
                                    </select>
                                </div>
                        </div>

                        <hr style="border: 1px solid #5585ce;"> <!-- Divisor para separar las secciones -->

                        <!-- Parte de detalle Radionucleidos -->
                            <div class="row g-1">
                                @for ($i = 1; $i <= 12; $i++)
                                    <div class="col-md-1 ">
                                        @if ($i <= 2) <!-- Mostrar los labels solo si $i es menor o igual a 2 -->
                                            <label for="radionucleido_{{ $i }}" class="label-negrita">Radionucleido</label>
                                        @endif
                                        <input type="datetime" name=""Radionucleido_{{ $i }}" class="form-control"
                                        value="{{ old("Radionucleido_{$i}", $fuente->{'Radionucleido_' . $i}) }}" readonly>                                       
                                    </div>

                                    <div class="col-md-1">
                                        @if ($i <= 2)
                                            <label for="Actividad_inicial_{{ $i }}" class="label-negrita">Act.Ini </label>
                                        @endif
                                        <input type="text" class="form-control" id="Actividad_inicial_{{ $i }}" name="Actividad_Inicial_{{ $i }}"
                                            value="{{ old("Actividad_Inicial_{$i}", $fuente->{'Actividad_Inicial_' . $i} ?? '') }}" readonly>
                                    </div>

                                    <div class="col-md-1">
                                        @if ($i <= 2)
                                            <label for="Actividad_{{ $i }}" class="label-negrita">Actividad </label>
                                        @endif
                                            <input type="text" class="form-control" id="Actividad_{{ $i }}" name="Actividad_{{ $i }}"
                                                value="{{ old("Actividad_{$i}", $fuente->{'Actividad_' . $i} ?? '') }}" readonly>
                                    </div>
                                    
                                    <div class="col-md-1">
                                            @if ($i <= 2)
                                                <label for="semiper_{{ $i }}" class="label-negrita">Semiper </label>
                                            @endif
                                            <input type="text" class="form-control" id="semiper_{{ $i }}" name="Semiperiodo_{{ $i }}_dias"
                                                value="{{ old("Semiperiodo_{$i}_dias", $fuente->{'Semiperiodo_' . $i . '_dias'} ?? '') }}" readonly>
                                    </div>

                                    <div class="col-md-2 @if ($i==1 or $i==3 or $i==5 or $i==7 or $i== 9 or $i== 11) separador @endif">
                                        @if ($i <= 2)
                                            <label for="Tipo_Emision_{{ $i }}" class="label-negrita">Tipo Emisión</label>
                                        @endif
                                        <input type="datetime" name="Tipo_Emision_{{ $i }}" class="form-control"
                                        value="{{ old("Tipo_Emision_{$i}", $fuente->{'Tipo_Emision_' . $i}) }}" readonly>                                                                                
                                    </div>

                                    @if ($i % 6 == 0)
                                        <div class="w-100"></div> <!-- Salto de línea cada 6 campos -->
                                    @endif
                                @endfor
                            </div>

                            @endif                                                            
                            <div class="row">
                                <div class="col-md-12">                                    
                                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                                                                
                                    <a href="{{ route('fuentes.index') }}" class="btn btn-secondary mt-3 ms-3">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
    </x-app-layout>