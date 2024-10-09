<style>
    /* Aplica el efecto solo a las filas dentro de tbody */
 #depositosTable tbody tr:hover {
     background-color: #d4edda !important; /* Color verde claro */
     color: #333; /* Cambia el color del texto (puedes modificarlo) */
     font-size: 1.1em; /* Agranda la letra un poco */
     font-weight: bold; /* Opcional: negrita para resaltar m�s */
     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra alrededor que da efecto 3D */
     border-radius: 5px; /* Bordes redondeados para darle m�s suavidad */
     transform: scale(1.02); /* Efecto de agrandar ligeramente */
     transition: all 0.3s ease; /* Suaviza el efecto de transici�n */
 }
 
 /* Efecto de transici�n suave para la fila */
 #fuentesTable tbody tr {
     transition: all 0.3s ease; /* Asegura una transici�n suave en todos los cambios */
 } 
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            &nbsp;
        </h2>
    </x-slot>

    <div class="py-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Lista de Depósitos') }}
        </h2>
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
                        <input type="text" id="searchBox" class="form-control" 
                        placeholder="Buscar depósito..." aria-label="Buscar depósito..." aria-describedby="search-icon">
                    </div>

                    <a href="{{ route('depositos.create') }}" class="btn btn-success mb-3">+ Agregar Depósito</a>                    

                    <table class="table table-striped table-hover table-bordered table-sm text-center" style="font-size:14px" id="depositosTable">
                        <thead class="table-success  text-center sm">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Observaciones</th>
                                <th>Activo</th>
                                <th>Acciones</th> <!-- Nueva columna para las acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($depositos as $deposito)
                            <tr>
                                <td>{{ $deposito->nombre }}</td>
                                <td>{{ $deposito->desc }}</td>
                                <td>{{ $deposito->obs }}</td>
                                <td>{{ $deposito->activo == 1 ? 'SI' : 'NO' }}</td>
                                <td>                                    
                                    <a href="{{ route('depositos.edit', $deposito->id) }}" 
                                        class="btn btn-sm" title="Editar"><img src="{{ asset('img/iconos/editar3.png') }}"  
                                        alt="Edit Icon"  style="width: 30px; height: 30px;" class="rounded-full me-2"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para la búsqueda -->
    <script>
        document.getElementById('searchBox').addEventListener('keyup', function() {
            var input = document.getElementById('searchBox');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('depositosTable');
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
    </script>
</x-app-layout>