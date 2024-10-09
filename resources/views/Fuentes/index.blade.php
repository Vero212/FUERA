<style>
   /* Aplica el efecto solo a las filas dentro de tbody */
#fuentesTable tbody tr:hover {
    background-color: #d4edda !important; /* Color verde claro */
    color: #333; /* Cambia el color del texto (puedes modificarlo) */
    font-size: 1.1em; /* Agranda la letra un poco */
    font-weight: bold; /* Opcional: negrita para resaltar mÃ¡s */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra alrededor que da efecto 3D */
    border-radius: 5px; /* Bordes redondeados para darle mÃ¡s suavidad */
    transform: scale(1.02); /* Efecto de agrandar ligeramente */
    transition: all 0.3s ease; /* Suaviza el efecto de transiciÃ³n */
}

/* Efecto de transiciÃ³n suave para la fila */
#fuentesTable tbody tr {
    transition: all 0.3s ease; /* Asegura una transiciÃ³n suave en todos los cambios */
}
    
    /* Clase personalizada para modal extra ancho */
    .modal-xl {
        max-width: 80% !important; /* Aumenta el ancho del modal a 90% de la ventana */
    }

    .bordered-field {
        border: 1px solid #6c757d; /* Color gris oscuro */
        padding: 2px; /* Espaciado interno */
        border-radius: 4px; /* Bordes redondeados */
        background-color: rgba(255, 255, 255, 0.1); /* Fondo ligeramente mÃ¡s oscuro */

        height: 40px; /* Ajusta este valor segÃºn el tamaÃ±o que desees */
        overflow: hidden;
        word-break: break-word; /* Evita que el contenido muy largo expanda */
        white-space: nowrap; /* Mantiene el texto en una sola lÃ­nea */
    }

    p{
        font-size:14px;
    }

    .separador {
        border-right: 2px solid #5585ce; /* Cambia el color y grosor del borde segÃÂºn tu necesidad */
        padding-left: 10px; /* AÃÂ±adir espacio para que el texto no quede pegado a la lÃÂ­nea */
        padding-right: 10px !important; /* AÃÂ±adir espacio para que el texto no quede pegado a la lÃÂ­nea */
        box-sizing: border-box; /* Asegura que los paddings y borders estÃÂ©n incluidos en el ancho */
    }   
    
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            &nbsp;
        </h2>        
    </x-slot>  
    <div class="py-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista de Fuentes') }}
        </h2>             
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="row mb-3 align-items-center text-left" style="display: flex;">                                               
                            {{-- Bot�n de agregar fuentes a la izquierda --}}
                            @if (Auth::user()->role == 1)
                                <div class="col-md-3">
                                    <a href="{{ route('fuentes.create') }}" class="btn btn-success mb-3">
                                        <i class="fas fa-plus"></i> Agregar Fuente
                                    </a>                                   
                                </div>
                            @endif
                            
    
                        <!-- Secci�n central: Reportes (m�s espacio) con borde -->
                    <div class="col-md-6 d-flex justify-content-center" style=" #ddd; padding: 10px; border-radius: 5px;">
                            <div style="width: 100%;">
                                {{-- <span class="font-weight-bold">Reportes</span> --}}
                                <div class="d-flex mt-2 justify-content-between" style="gap: 15px;">
                                    <!-- Subsecci�n: Por Fuente -->
                                    <div>
                                        <span>Letra:</span>
                                        <div class="input-group" style="width: 100px; display: inline-block;" >
                                            <input type="text" id="filterBox" class="form-control" placeholder="Filtrar" style="width:80px;height:40px">
                                        </div>

                                        {{-- PDF POR numero de fuente --}}
                                        <button class="btn btn-light" id="btnExportPDF" onclick="generarPDF()" title="PDF por Número de Fuente">
                                            <i class="fas fa-file-pdf fa-2X" style="color: red;"></i>
                                        </button>     
                                        
                                        {{-- EXCEL por numero de fuente --}}
                                        <button class="btn btn-light ml-1" id="btnExportExcel" onclick="generarCSV()">
                                            <i class="fas fa-file-excel fa-2X" style="color: green;"></i>
                                        </button>
                                    </div>
    
                                    <!-- Subseccion: Dadas de Baja -->
                                    <div>
                                        <span>Dadas de Baja</span>
                                        <button class="btn btn-light ml-1" id="btnBajasPDF" onclick="generarPDFBajas()">
                                            <i class="fas fa-file-pdf fa-2X" style="color: red;"></i>
                                        </button>
                                        <button class="btn btn-light ml-1" id="btnBajasExcel" onclick="generarCSVBajas()">
                                            <i class="fas fa-file-excel fa-2X" style="color: green;"></i>
                                        </button>
                                    </div>
    
                                    <!-- Subsecci�n: Uso Condicional -->
                                    <div>
                                        <span>Uso Condicional(Ver):</span>
                                        <button class="btn btn-light ml-1" id="btnCondicionalPDF">
                                            <i class="fas fa-file-pdf fa-2X" style="color: red;"></i>
                                        </button>
                                        <button class="btn btn-light ml-1" id="btnCondicionalExcel">
                                            <i class="fas fa-file-excel fa-2X" style="color: green;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Secci�n derecha: Campo de b�squeda (menor espacio) -->
                        <div class="col-md-2 d-flex justify-content-end">
                            <div class="input-group" style="width: 200px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="search-icon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" id="searchBox" class="form-control" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="search-icon">
                            </div>
                        </div>
                    </div>                    

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

                    <table class="table table-striped table-hover table-bordered table-sm text-center" id="fuentesTable">
                        <thead class="table-success  text-center">
                            <tr>
                                <th>Fuente</th><th>Clasificación</th><th>Tipo</th><th>Geometrí­a</th><th>Dimensiones</th>                                
                                <th>Rad1</th><th>Rad2</th><th>Rad3</th><th>Rad4</th><th>Rad5</th><th>Rad6</th><th>Rad7</th><th>Rad8</th><th>Rad9</th>
                                <th>Rad10</th><th>Rad11</th><th>Rad12</th>
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

                                    <!-- BotÃ³n para ver mÃ¡s detalles en un modal -->
                                    <td>
                                        <button class="btn btn-sm" data-toggle="modal" data-target="#fuenteModal" 
                                                data-fuente="{{ json_encode($fuente) }}" title="Ver detalles de la fuente">
                                                <img src="{{ asset('img/iconos/Ver2.png') }}" alt="Ver Icon" style="width: 30px; height: 30px;" class="rounded-full me-2">                                             
                                        </button>
                                    
                                        @if (auth()->user()->role === 1)
                                        <!-- Botón para edición completa -->
                                        <a href="{{ route('fuentes.edit', ['id' => $fuente->id, 'modo' => 'edicion']) }}" class="btn  btn-sm">
                                            <img src="{{ asset('img/iconos/editar3.png') }}" alt="Editar Icon" style="width: 30px; height: 30px;" class="rounded-full me-2" title="Editar fuente">
                                        </a>
                                        
                                        <!-- Botón para baja (solo lectura excepto ciertos campos) -->
                                        <a href="{{ route('fuentes.edit', ['id' => $fuente->id, 'modo' => 'baja']) }}" class="btn  btn-sm">
                                            <img src="{{ asset('img/iconos/baja2.png') }}" alt="Baja Icon" style="width: 30px; height: 30px;" class="rounded-full me-2" title="Baja de fuente">
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
                        <strong>ClasificaciÃ³n</strong>
                        <p id="modalClasif" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>GeometrÃ­a</strong>
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
                    <div class="col-md-2">
                        <strong>Fecha Ref 1:</strong>
                        <p id="modalFecha_Referencia_1" class="bordered-field"></p>
                    </div>
                    <div class="col-md-2">
                        <strong>Fecha Baja Real:</strong>
                        <p id="modalBaja_Real" class="bordered-field"></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Motivo de Baja:</strong>
                        <p id="modalMotivo_Baja" class="bordered-field"></p>
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
                            <div class="w-100"></div> <!-- Salto de lÃÂ­nea cada 6 campos -->
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

    <!-- JavaScript para la bÃºsqueda -->
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
            //$('#modalActividad_Inicial_1').text(parseFloat(fuente.Actividad_Inicial_1).toFixed(10)); // CON 10 DECIMALES
            //$('#modalActividad_Inicial_1').text(parseFloat(fuente.Actividad_Inicial_1).toExponential()); // NOTACION CIENFIFICA
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

            // Realizar cálculo para el campo calculado
            //levantar la fecha de referencia
            //sacar la diferencia entre la fecha de referencia y el dia de hoy 
            //ese resultado dividido lo q tenia en semiperiodo lo guarda en semi1 
            //toma la actividad inicial y la multiplica acti = actini * (System.Math.Exp(-0.693 * (tiem / semi))) por la division de tiempo y semiperiodo 
            //y ese es el resultado final
 
            // Recorremos los 12 radionucleidos
            for (var i = 1; i <= 12; i++) {
    // Obtener los valores para cada radionucleido
    var semi = fuente['Semiperiodo_' + i + '_dias']; // Semiperiodo en días
    var actini = fuente['Actividad_Inicial_' + i]; // Actividad inicial
    var fref = fuente['Fecha_Referencia_1']; // Fecha de referencia (misma para todos)

    // Verificar si hay una fecha de referencia válida
    if (fref && fref !== "12:00:00 a.m.") {
        var hoy = new Date(); // Fecha de hoy
        var fechaReferencia = new Date(fref); // Convertir la fecha de referencia a objeto Date

        // Verificar si la fecha de referencia es válida
        if (isNaN(fechaReferencia.getTime())) {
            console.error("Fecha de referencia no válida:", fref);
            $('#modalCalculada' + i).text("4");
            continue; // Salir del bucle para este índice
        }

        // Calcular la diferencia en días entre la fecha de referencia y hoy
        var tiem = Math.floor((hoy - fechaReferencia) / (1000 * 60 * 60 * 24)); // Diferencia en días

        // Verificar que semi no sea cero
        if (semi === 0) {            
            console.error("Semiperiodo es cero para el radionucleido " + i);
            $('#modalCalculada' + i).text("1");
            continue; // Salir del bucle para este índice
        }

        // Calcular la fracción del semiperiodo que ha pasado
        var semi1 = tiem / semi;

        // Calcular la actividad usando la fórmula de desintegración radiactiva
        if (isNaN(actini)) {           
            console.error("Actividad inicial no válida:", actini);
            $('#modalCalculada' + i).text("2");
            continue; // Salir del bucle para este índice
        }

        var acti = actini * Math.exp(-0.693 * semi1); // Fórmula A(t) = A_0 * e^(-?t)

        // Asignar el valor calculado al campo en el modal
        $('#modalCalculada' + i).text(acti.toFixed(10)); // Redondea a 10 decimales

        // Cambiar el color del fondo si han pasado más de 2 semiperiodos
        if (semi1 > 2) {
            $('#modalActividad_Inicial_' + i).css('background-color', 'yellow');
        }
    } else {
        // Si no hay fecha de referencia válida, poner la actividad en 0
        $('#modalCalculada' + i).text("3");
    }
}
                    
                });
</script>
<script>
    function generarPDF() {
        const letra = document.getElementById('filterBox').value; // Obtener el valor del filtro
       
        const url = `{{ route('fuentes.pdf') }}`; // Cambia esto seg�n tu ruta definida

        // Hacer una solicitud POST para generar el PDF
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Aseg�rate de incluir el token CSRF
            },
            body: JSON.stringify({ filter: letra })
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Error al generar el PDF');
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'fuentes_por_letra.pdf'; // Nombre del archivo descargado
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => {
            console.error(error);
        });
    }

    function generarCSV() {
        const letra = document.getElementById('filterBox').value; // Obtener el valor del filtro
       
        const url = `{{ route('fuentes.exportar.csv') }}`; // Aseg�rate de que la ruta es correcta

        // Hacer una solicitud POST para generar el CSV
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Aseg�rate de incluir el token CSRF
            },
            body: JSON.stringify({ filter: letra })
        })
        .then(response => {
            if (response.ok) {
                return response.blob(); // Obtener el archivo como blob
            }
            throw new Error('Error al generar el CSV');
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'fuentes_por_letra.csv'; // Nombre del archivo descargado
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => {
            console.error(error);
        });
    }

    //Bajas
    function generarPDFBajas() {
        const letra = document.getElementById('filterBox').value; // Obtener el valor del filtro
       
        const url = `{{ route('fuentesbaja.pdf') }}`; // Cambia esto seg�n tu ruta definida

        // Hacer una solicitud POST para generar el PDF
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Aseg�rate de incluir el token CSRF
            },
            body: JSON.stringify({ filter: letra })
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            }
            throw new Error('Error al generar el PDF');
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'fuentes_de_baja.pdf'; // Nombre del archivo descargado
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => {
            console.error(error);
        });
    }

    function generarCSVBajas() {
        const letra = document.getElementById('filterBox').value; // Obtener el valor del filtro
       
        const url = `{{ route('fuentesbajas.exportar.csv') }}`; // Aseg�rate de que la ruta es correcta

        // Hacer una solicitud POST para generar el CSV
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Aseg�rate de incluir el token CSRF
            },
            body: JSON.stringify({ filter: letra })
        })
        .then(response => {
            if (response.ok) {
                return response.blob(); // Obtener el archivo como blob
            }
            throw new Error('Error al generar el CSV');
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'fuentes_de_baja.csv'; // Nombre del archivo descargado
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => {
            console.error(error);
        });
    }

    
</script>

</x-app-layout>