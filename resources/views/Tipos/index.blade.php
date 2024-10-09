<style>
    /* Aplica el efecto solo a las filas dentro de tbody */
 #tiposTable tbody tr:hover {
     background-color: #d4edda !important; /* Color verde claro */
     color: #333; /* Cambia el color del texto (puedes modificarlo) */
     font-size: 1.1em; /* Agranda la letra un poco */
     font-weight: bold; /* Opcional: negrita para resaltar más */
     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra alrededor que da efecto 3D */
     border-radius: 5px; /* Bordes redondeados para darle más suavidad */
     transform: scale(1.02); /* Efecto de agrandar ligeramente */
     transition: all 0.3s ease; /* Suaviza el efecto de transición */
 }
 
 /* Efecto de transición suave para la fila */
 #fuentesTable tbody tr {
     transition: all 0.3s ease; /* Asegura una transición suave en todos los cambios */
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
            {{ __('Lista de Tipos') }}
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
                        placeholder="Buscar Tipo..." aria-label="Buscar Tipo..." aria-describedby="search-icon">
                    </div>


                    <a href="{{ route('tipos.create') }}" class="btn btn-success mb-3">+ Agregar Tipo</a>                   

                    <table class="table table-striped table-hover table-bordered table-sm text-center" style="font-size:14px" id="tiposTable">
                        <thead class="table-success  text-center sm">
                            <tr>
                                <th>Nombre</th>
                                <th>DescripciÃ³n</th>
                                <th>Observaciones</th>
                                <th>Activo</th>
                                <th>Acciones</th> <!-- Nueva columna para las acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>{{ $tipo->nombre }}</td>
                                <td>{{ $tipo->desc }}</td>
                                <td>{{ $tipo->obs }}</td>
                                <td>{{ $tipo->activo == 1 ? 'SI' : 'NO' }}</td>
                                <td>
                                    <a href="{{ route('tipos.edit', $tipo->id) }}" 
                                        class="btn btn-sm" title="Editar"><img src="{{ asset('img/iconos/editar3.png') }}"  
                                        alt="Edit Icon" style="width: 30px; height: 30px;" class="rounded-full me-2"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para la bÃºsqueda -->
    <script>
        document.getElementById('searchBox').addEventListener('keyup', function() {
            var input = document.getElementById('searchBox');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('tiposTable');
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