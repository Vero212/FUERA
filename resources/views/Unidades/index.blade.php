<style>
/* Asegurarse de que el hover solo se aplique a las filas de tbody */
#unidadesTable tbody tr:hover {
        background-color: rgb(221, 211, 211) !important; /* Color de fondo al hacer hover */
    }    
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Unidades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Mensajes de exito y error -->
                    @if (session('success'))
                     <div class="alert alert-success">
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

                    <a href="{{ route('unidades.create') }}" class="btn btn-success mb-3">Agregar Unidad</a>

                    <!-- Grupo de entrada para b�squeda -->
                    <div class="input-group mb-3" style="width: 300px; float: right;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="search-icon">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" id="searchBox" class="form-control" placeholder="Buscar Unidad..." aria-label="Buscar Unidad..." aria-describedby="search-icon">
                    </div>

                    <table class="table table-striped table-hover table-bordered table-sm" style="font-size:14px" id="unidadesTable">
                        <thead class="table-dark small">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Observaciones</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unidades as $unidad)
                            <tr>
                                <td>{{ $unidad->nombre }}</td>
                                <td>{{ $unidad->desc }}</td>
                                <td>{{ $unidad->obs }}</td>
                                <td>{{ $unidad->activo == 1 ? 'SI' : 'NO' }}</td>
                                <td>
                                    <a href="{{ route('unidades.edit', $unidad->id) }}" class="btn btn-primary btn-sm">Editar</a>
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
            var table = document.getElementById('unidadesTable');
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