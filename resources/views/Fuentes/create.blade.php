<style>
    .separador {
        border-right: 2px solid #5585ce; /* Cambia el color y grosor del borde según tu necesidad */
        padding-left: 10px; /* Añadir espacio para que el texto no quede pegado a la línea */
        padding-right: 10px !important; /* Añadir espacio para que el texto no quede pegado a la línea */
        box-sizing: border-box; /* Asegura que los paddings y borders estén incluidos en el ancho */
    }

  .row .col-md-1 {
    padding-left: 2px; /* Ajusta este valor seg�n el espacio que desees */
    padding-right: 2px; /* Ajusta este valor seg�n el espacio que desees */
    }


    .label-negrita{
        font-weight: bold;
    }
 
    
    </style>    
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Agregar Fuente') }}
            </h2>
        </x-slot>
    
        <div class="container py-3" style="width: 100%;max-width:1600px">
            <div class="card shadow-xl">
                <div class="card-body">

                     <!-- Mensajes de error -->
                     {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <form action="{{ route('fuentes.store') }}" method="POST">
                        @csrf
    
                        <div class="row">
                            <div class="col-md-1">
                                <label for="Id_Fuente_Radiactiva" class="label-negrita">Id Fuente:</label>
                                <input type="text" name="Id_Fuente_Radiactiva" id="Id_Fuente_Radiactiva" class="form-control" required>
                                @error('Id_Fuente_Radiactiva')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                                
                            <div class="col-md-2">
                                <label for="Tipo_Fuente" class="label-negrita">Tipo Fuente:</label>
                                <select name="Tipo_Fuente" id="Tipo_Fuente" class="form-control">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('Tipo_Fuente')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror       
                            </div>
    
                            <div class="col-md-2">
                                <label for="Clasificacion" class="label-negrita">Clasificación:</label>
                                <select name="Clasificacion" id="Clasificacion" class="form-control">
                                    <option value="">Seleccione un estado</option>
                                    <option value="PRIMARIA">Primaria</option>
                                    <option value="SECUNDARIA">Secundaria</option>
                                    <option value="TERCIARIA">Terciaria</option>
                                    <option value="STD INTERNO">STD Interno</option>
                                </select>
                                @error('Clasificacion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            
                            <div class="col-md-3">
                                <label for="Geometria_Soporte" class="label-negrita">Geometría/Soporte:</label>
                                <select name="Geometria_Soporte" id="Geometria_Soporte" class="form-control">
                                    <option value="">Seleccione una geometría</option>
                                    @foreach($geometrias as $geometria)
                                        <option value="{{ $geometria->id }}">{{ $geometria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>                            
    
                            <div class="col-md-2">
                                <label for="Dimensiones" class="label-negrita">Dimensiones:</label>
                                <input type="text" name="Dimensiones" id="Dimensiones" class="form-control">
                            </div>
                            
                            <div class="col-md-2">
                                <label for="Estado_Fuente" class="label-negrita">Estado:</label>
                                <select name="Estado_Fuente" id="Estado_Fuente" class="form-control">
                                    <option value="">Seleccione un estado</option>
                                    <option value="ACT">ACT</option>
                                    <option value="BAJA">BAJA</option>
                                    <option value="NO CALIBRADA">NO CALIBRADA</option>
                                    <option value="USO">USO</option>
                                </select>
                                @error('Estado_Fuente')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <br><br><br><br>
                            
                        </div>
    
                        <div class="row">
                            <div class="col-md-1">
                                <label for="Fuente_Primaria_Origen" class="label-negrita">Origen:</label>
                                <input type="text" name="Fuente_Primaria_Origen" id="Fuente_Primaria_Origen" class="form-control">
                            </div>                            

                             <div class="col-md-2">
                                <label for="Unidad_Actividad" class="label-negrita">Unidad Activ:</label>
                                <select name="Unidad_Actividad" id="Unidad_Actividad" class="form-control">
                                    <option value="">Seleccione una unidad</option>
                                    @foreach($unidades as $unidad)
                                        <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="Lugar_Deposito" class="label-negrita">Lugar/Depósito:</label>
                                <select name="Lugar_Deposito" id="Lugar_Deposito" class="form-control">
                                    <option value="">Seleccione un depósito</option>
                                    @foreach($depositos as $deposito)
                                        <option value="{{ $deposito->id }}">{{ $deposito->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="Uso_Origen" class="label-negrita">Uso Original:</label>
                                <select name="Uso_Origen" id="Uso_Origen" class="form-control">
                                    <option value="">Seleccione un uso</option>
                                    @foreach($usos as $uso)
                                        <option value="{{ $uso->id }}">{{ $uso->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-md-2">
                                <label for="Proveedor_Origen" class="label-negrita">Proveedor Origen:</label>
                                <input type="text" name="Proveedor_Origen" id="Proveedor_Origen" class="form-control">
                            </div>
    
                            <div class="col-md-2">
                                <label for="Id_Fabricacion" class="label-negrita">Id Fabricación:</label>
                                <input type="text" name="Id_Fabricacion" id="Id_Fabricacion" class="form-control">
                                @error('Id_Fabricacion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror    
                            </div>  
                                                                             
                        </div>
                        <br>
    
                        <div class="row">
                            <div class="col-md-4">
                                <label for="Usuario_Principal" class="label-negrita">Usuario Principal:</label>
                                <input type="text" name="Usuario_Principal" id="Usuario_Principal" class="form-control">
                            </div>
    
                            <div class="col-md-4">
                                <label for="Fecha_Referencia_1" class="label-negrita">Fecha Ref 1:</label>
                                <input type="datetime-local" name="Fecha_Referencia_1" id="Fecha_Referencia_1" class="form-control">
                            </div>
    
                            <div class="col-md-4">
                                <label for="Baja_Real" class="label-negrita">Fecha Baja Real:</label>
                                <input type="datetime-local" name="Baja_Real" id="Baja_Real" class="form-control">
                            </div>
                        </div>
    
                        <hr style="border: 1px solid #5585ce;"> <!-- Divisor para separar las secciones -->
    
                        <!--Parte de detalle -->
                        <div class="row g-1">
                            @for ($i = 1; $i <= 12; $i++)
                                <div class="col-md-1 ">
                                    @if ($i <= 2) <!-- Mostrar los labels solo si $i es menor o igual a 2 -->
                                        <label for="radionucleido_{{ $i }}" class="label-negrita">Radionucleido</label>
                                    @endif
                                    <select class="form-control" id="radionucleido_{{ $i }}" name="Radionucleido_{{ $i }}">
                                        <option value="">Seleccione</option><option value="Am/Be">Am/Be</option><option value="Am241">Am241</option>
                                        <option value="Am243">Am243</option><option value="Ba133">Ba133</option><option value="Bi207">Bi207</option>
                                        <option value="BLANCO">BLANCO</option><option value="C14">C14</option><option value="Ce144">Ce144</option>
                                        <option value="C136">C136</option><option value="Cm244">Cm244</option><option value="Co57">Co57</option>
                                        <option value="Co60">Co60</option><option value="Cr51">Cr51</option><option value="Cs134">Cs134</option>
                                        <option value="Cs137">Cs137</option><option value="Eu152">Eu152</option><option value="Fe59">Fe59</option>
                                        <option value="H3">H3</option><option value="Ho166">Ho166</option><option value="I131">I131</option>
                                        <option value="Ir192">Ir192</option><option value="Kr85">Kr85</option><option value="Mn54">Mn54</option>
                                        <option value="Po210">Po210</option><option value="Pu239">Pu239</option><option value="Pu242">Pu242</option>
                                        <option value="Ru103">Ru103</option><option value="Ru106">Ru106</option><option value="Pu242">Pu242</option>
                                        <option value="Sb125">Sb125</option><option value="Sr89">Sr89</option><option value="Sr90">Sr90</option>
                                        <option value="Sr90/Y90">Sr90/Y90</option><option value="T1024">T1204</option><option value="U233">U233</option>
                                        <option value="Uranio Enriq">Uranio Enriq.</option>
                                    </select>
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                    <label for="Actividad_inicial_{{ $i }}" class="label-negrita">Act.Ini </label>
                                    @endif                                    
                                    <input type="text" class="form-control" id="Actividad_inicial_{{ $i }}" name="Actividad_Inicial_{{ $i }}">
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                    <label for="Actividad_{{ $i }}" class="label-negrita">Actividad </label>
                                    @endif
                                    <input type="text" class="form-control" id="Actividad_{{ $i }}" name="Actividad_{{ $i }}">                                    
                                </div>
                        
                                <div class="col-md-1">
                                    @if ($i <= 2)
                                    <label for="semiper_{{ $i }}" class="label-negrita">Semiper </label>
                                    @endif
                                    <input type="text" class="form-control" id="semiper_{{ $i }}" name="Semiperiodo_{{ $i }}_dias">                                    
                                </div>
                        
                                <div class="col-md-2 @if ($i==1 or $i==3 or $i==5 or $i==7 or $i== 9 or $i== 11) separador @endif">
                                    @if ($i <= 2)
                                        <label for="Tipo_Emision_{{ $i }}" class="label-negrita">Tipo Emisi�n</label>
                                    @endif                                    
                                    
                                    <select name="Tipo_Emision_{{ $i }}" id="Tipo_Emision_{{ $i }}" class="form-control">
                                            <option value="">Seleccione</option>
                                            @foreach($emisiones as $emision)
                                                <option value="{{ $emision->nombre }}">{{ $emision->nombre }}</option>
                                            @endforeach
                                        </select>                                                                    
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