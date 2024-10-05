<style>
    /* Asegurarse de que el hover solo se aplique a las filas de tbody */
    #fuentesTable tbody tr:hover {
        background-color: rgb(221, 211, 211) !important; /* Color de fondo al hacer hover */
    }
    
    /* Clase personalizada para modal extra ancho */
    .modal-xl {
        max-width: 80% !important; /* Aumenta el ancho del modal a 90% de la ventana */
    }

    .bordered-field {
        border: 1px solid #6c757d; /* Color gris oscuro */
        padding: 2px; /* Espaciado interno */
        border-radius: 4px; /* Bordes redondeados */
        background-color: rgba(255, 255, 255, 0.1); /* Fondo ligeramente más oscuro */

        height: 40px; /* Ajusta este valor según el tamaño que desees */
        overflow: hidden;
        word-break: break-word; /* Evita que el contenido muy largo expanda */
        white-space: nowrap; /* Mantiene el texto en una sola línea */
    }

    p{
        font-size:14px;
    }

    .separador {
        border-right: 2px solid #5585ce; /* Cambia el color y grosor del borde segÃºn tu necesidad */
        padding-left: 10px; /* AÃ±adir espacio para que el texto no quede pegado a la lÃ­nea */
        padding-right: 10px !important; /* AÃ±adir espacio para que el texto no quede pegado a la lÃ­nea */
        box-sizing: border-box; /* Asegura que los paddings y borders estÃ©n incluidos en el ancho */
    }

   

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Fuentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div style="margin-left:3px">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Grupo de entrada para busqueda -->
                    <div class="input-group mb-3" style="width: 300px; float: right;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="search-icon">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="Buscar fuente..." aria-label="Buscar fuente..." aria-describedby="search-icon">
                    </div>

                    {{-- Valida que solo los Responsables Operativos puedan agregar fuentes --}}
                    @if (Auth::user()->role == 1)

                        <a href="{{ route('fuentes.create') }}" class="btn btn-success mb-3">
                            <i class="fas fa-plus"></i> Agregar Fuente
                        </a>
                        <!-- Mensajes de Exito y error -->
                        @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @endif

                    <table class="table table-striped table-hover table-bordered table-sm" id="fuentesTable">
                        <thead class="table-dark small">
                            <tr>
                                <th>Fuente</th><th>Clasif</th><th>Tipo</th><th>Geometria</th><th>Dimensiones</th>                                
                                <th>RAD1</th><th>RAD2</th><th>RAD3</th><th>RAD4</th><th>RAD5</th><th>RAD6</th><th>RAD7</th><th>RAD8</th><th>RAD9</th>
                                <th>RAD10</th><th>RAD11</th><th>RAD12</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @foreach($fuentes as $fuente)
                                <tr>
                                    <td>{{ $fuente->Id_Fuente_Radiactiva }}</td>
                                    <td>{{ $fuente->Clasificacion }}</td>
                                    <td>{{ $fuente->Tipo_Fuente }}</td>                                    
                                    <td>{{ $fuente->Geometria_Soporte }}</td>
                                    <td>{{ $fuente->Dimensiones }}</td>                                    

                                    <td>{{ $fuente->Radionucleido_1 }}</td>
                                    <td>{{ $fuente->Radionucleido_2 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_3 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_4 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_5 }}</td>                            
                                    <td>{{ $fuente->Radionucleido_6 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_7 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_8 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_9 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_10 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_11 }}</td>                                    
                                    <td>{{ $fuente->Radionucleido_12 }}</td>                                                                        

                                    <!-- Botón para ver más detalles en un modal -->
                                    <td>
                                        <button class="btn btn-sm" data-toggle="modal" data-target="#fuenteModal" 
                                                data-fuente="{{ json_encode($fuente) }}" title="Ver detalles de la fuente">
                                                <img src="{{ asset('img/iconos/Ver2.png') }}" alt="User Icon" class="w-6 h-6 rounded-full me-2">                                             
                                        </button>

                                    
                                        @if (auth()->user()->role === 1)
                                        <a href="{{ route('fuentes.edit', $fuente->id) }}" class="btn  btn-sm">
                                            <img src="{{ asset('img/iconos/editar3.png') }}" alt="User Icon" class="w-6 h-6 rounded-full me-2">
                                        </a>                                        
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- Modal para mostrar detalles completos de la fuente -->

<div class="modal fade" id="fuenteModal" tabindex="-1" role="dialog" aria-labelledby="fuenteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="fuenteModalLabel">Detalles de la Fuente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <strong>Fuente</strong>                        
                        <p id="modalFuente" class="bordered-field"></p>
                    </div>                    
                    <div class="col-md-2">
                        <strong>Tipo</strong>
                        <p id="modalTipo" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Clasificación</strong>
                        <p id="modalClasif" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Geometría</strong>
                        <p id="modalGeometria" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Dimensiones:</strong>
                        <p id="modalDimensiones" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Estado:</strong>
                        <p id="modalEstado_Fuente" class="bordered-field"></p>
                    </div>
                </div>

                <div class="row">                                        
                    <div class="col-md-2">
                        <strong>Fuente de Origen:</strong>
                        <p id="modalFuente_Primaria_Origen" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Unid/Activ:</strong>
                        <p id="modalUnidad_Actividad" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Lugar/Deposit:</strong>
                        <p id="modalLugar_Deposito" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Proveedor Orig:</strong>
                        <p id="modalProveedor_Origen" class="bordered-field"></p>
                    </div> 
                    <div class="col-md-2">
                        <strong>Id Fabric:</strong>
                        <p id="modalId_Fabricacion" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Uso Original:</strong>
                        <p id="modalUso_Origen" class="bordered-field"></p>
                    </div>  
                </div>

                <div class="row">                    
                    <div class="col-md-4">
                        <strong>Usuario Princ:</strong>
                        <p id="modalUsuario_Principal" class="bordered-field"></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha Ref 1:</strong>
                        <p id="modalFecha_Referencia_1" class="bordered-field"></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha Baja Real:</strong>
                        <p id="modalBaja_Real" class="bordered-field"></p>
                    </div>
                </div>

                <hr style="border: 1px solid #5585ce;"> <!-- Divisor para separar las secciones -->

                <!--Parte de detalle -->
                <div class="row g-1">
                    @for ($i = 1; $i <= 12; $i++)
                        <div class="col-md-1 ">
                            @if ($i <= 2) <!-- Mostrar los labels solo si $i es menor o igual a 2 -->
                            <strong>Radionucleido</strong>
                            @endif
                            <p id="modalRad<?= $i ?>" class="bordered-field"></p>
                        </div>
                
                        <div class="col-md-1">
                            @if ($i <= 2)
                            <strong>Act.Ini</strong>
                            @endif                                    
                            <p id="modalActividad_Inicial_<?= $i ?>" class="bordered-field"></p>
                        </div>
                
                        <div class="col-md-1">
                            @if ($i <= 2)
                            <strong>Actividad</strong>
                            @endif
                            <p id="modalCalculada<?= $i ?>" class="bordered-field"></p>                              
                        </div>
                
                        <div class="col-md-1">
                            @if ($i <= 2)
                            <strong>Semiperiodo</strong>
                            @endif
                            <p id="modalSemiperiodo_<?= $i ?>_dias" class="bordered-field"></p>                                  
                        </div>
                
                        <div class="col-md-2 @if ($i==1 or $i==3 or $i==5 or $i==7 or $i== 9 or $i== 11) separador @endif">
                            @if ($i <= 2)
                            <strong>Tipo Emision</strong>
                            @endif                                    
                            
                            <p id="modalTipo_Emision_<?= $i ?>" class="bordered-field"></p>                                                                   
                        </div>
                
                        @if ($i % 6 == 0)
                            <div class="w-100"></div> <!-- Salto de lÃ­nea cada 6 campos -->
                        @endif
                    @endfor
                </div>                                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                
            </div>
        </div>
    </div>
</div>

    <!-- JavaScript para la búsqueda -->
    <script>
        document.getElementById('searchBox').addEventListener('keyup', function() {
            var input = document.getElementById('searchBox');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('fuentesTable');
            var trs = table.getElementsByTagName('tr');

            for (var i = 1; i < trs.length; i++) {
                var tds = trs[i].getElementsByTagName('td');
                var found = false;

                for (var j = 0; j < tds.length; j++) {
                    if (tds[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }

                if (found) {
                    trs[i].style.display = '';
                } else {
                    trs[i].style.display = 'none';
                }
            }
        });

        // JavaScript para mostrar detalles en el modal
        $('#fuenteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var fuente = button.data('fuente');

            // Poner los datos de la fuente en el modal
            $('#modalFuente').text(fuente.Id_Fuente_Radiactiva);
            $('#modalId_Fabricacion').text(fuente.Id_Fabricacion);
            $('#modalClasif').text(fuente.Clasificacion);
            $('#modalFuente_Primaria_Origen').text(fuente.Fuente_Primaria_Origen);
            $('#modalTipo').text(fuente.Tipo_Fuente);
            $('#modalGeometria').text(fuente.Geometria_Soporte);
            $('#modalDimensiones').text(fuente.Dimensiones);
            $('#modalUnidad_Actividad').text(fuente.Unidad_Actividad);
            $('#modalDimensiones').text(fuente.Dimensiones);

            $('#modalRad1').text(fuente.Radionucleido_1);
            $('#modalActividad_Inicial_1').text(fuente.Actividad_Inicial_1);
            $('#modalTipo_Emision_1').text(fuente.Tipo_Emision_1);
            $('#modalSemiperiodo_1_dias').text(fuente.Semiperiodo_1_dias);

            $('#modalRad2').text(fuente.Radionucleido_2);
            $('#modalActividad_Inicial_2').text(fuente.Actividad_Inicial_2);
            $('#modalTipo_Emision_2').text(fuente.Tipo_Emision_2);
            $('#modalSemiperiodo_2_dias').text(fuente.Semiperiodo_2_dias);

            $('#modalRad3').text(fuente.Radionucleido_3);
            $('#modalActividad_Inicial_3').text(fuente.Actividad_Inicial_3);
            $('#modalTipo_Emision_3').text(fuente.Tipo_Emision_3);
            $('#modalSemiperiodo_3_dias').text(fuente.Semiperiodo_3_dias);

            $('#modalRad4').text(fuente.Radionucleido_4);
            $('#modalActividad_Inicial_4').text(fuente.Actividad_Inicial_4);
            $('#modalTipo_Emision_4').text(fuente.Tipo_Emision_4);
            $('#modalSemiperiodo_4_dias').text(fuente.Semiperiodo_4_dias);

            $('#modalRad5').text(fuente.Radionucleido_5);
            $('#modalActividad_Inicial_5').text(fuente.Actividad_Inicial_5);
            $('#modalTipo_Emision_5').text(fuente.Tipo_Emision_5);
            $('#modalSemiperiodo_5_dias').text(fuente.Semiperiodo_5_dias);

            $('#modalRad6').text(fuente.Radionucleido_6);
            $('#modalActividad_Inicial_6').text(fuente.Actividad_Inicial_6);
            $('#modalTipo_Emision_6').text(fuente.Tipo_Emision_6);
            $('#modalSemiperiodo_6_dias').text(fuente.Semiperiodo_6_dias);

            $('#modalRad7').text(fuente.Radionucleido_7);
            $('#modalActividad_Inicial_7').text(fuente.Actividad_Inicial_7);
            $('#modalTipo_Emision_7').text(fuente.Tipo_Emision_7);
            $('#modalSemiperiodo_7_dias').text(fuente.Semiperiodo_7_dias);

            $('#modalRad8').text(fuente.Radionucleido_8);
            $('#modalActividad_Inicial_8').text(fuente.Actividad_Inicial_8);
            $('#modalTipo_Emision_8').text(fuente.Tipo_Emision_8);
            $('#modalSemiperiodo_8_dias').text(fuente.Semiperiodo_8_dias);

            $('#modalRad9').text(fuente.Radionucleido_9);
            $('#modalActividad_Inicial_9').text(fuente.Actividad_Inicial_9);
            $('#modalTipo_Emision_9').text(fuente.Tipo_Emision_9);
            $('#modalSemiperiodo_9_dias').text(fuente.Semiperiodo_9_dias);

            $('#modalRad10').text(fuente.Radionucleido_10);
            $('#modalActividad_Inicial_10').text(fuente.Actividad_Inicial_10);
            $('#modalTipo_Emision_10').text(fuente.Tipo_Emision_10);
            $('#modalSemiperiodo_10_dias').text(fuente.Semiperiodo_10_dias);

            $('#modalRad11').text(fuente.Radionucleido_11);
            $('#modalActividad_Inicial_11').text(fuente.Actividad_Inicial_11);
            $('#modalTipo_Emision_11').text(fuente.Tipo_Emision_11);
            $('#modalSemiperiodo_11_dias').text(fuente.Semiperiodo_11_dias);

            $('#modalRad12').text(fuente.Radionucleido_12);
            $('#modalActividad_Inicial_12').text(fuente.Actividad_Inicial_12);
            $('#modalTipo_Emision_12').text(fuente.Tipo_Emision_12);
            $('#modalSemiperiodo_12_dias').text(fuente.Semiperiodo_12_dias);

            $('#modalProveedor_Origen').text(fuente.Proveedor_Origen);
            $('#modalUso_Origen').text(fuente.Uso_Origen);
            $('#modalUsuario_Principal').text(fuente.Usuario_Principal);
            $('#modalFecha_Referencia_1').text(fuente.Fecha_Referencia_1);
            $('#modalFecha_Referencia_2').text(fuente.Fecha_Referencia_2);
            $('#modalEstado_Fuente').text(fuente.Estado_Fuente);
            $('#modalActividad_Corregida').text(fuente.Actividad_Corregida);
            $('#modalFecha_Baja_Estimada').text(fuente.Fecha_Baja_Estimada);
            $('#modalLugar_Deposito').text(fuente.Lugar_Deposito);
            $('#modalEstado').text(fuente.Estado);
            $('#modalBaja_Real').text(fuente.Baja_Real);
            $('#modalResponsable').text(fuente.Responsable);
            $('#modalMotivo_Baja').text(fuente.Motivo_Baja);
            $('#modalActividad_Calc').text(fuente.Actividad_Calc);
            
        });
    </script>
</x-app-layout>