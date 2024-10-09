<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Emisión') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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

                    <form action="{{ route('emisiones.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="desc">Descripción</label>
                            <input type="text" name="desc" class="form-control" value="{{ old('desc') }}">
                        </div>
                        <div class="form-group">
                            <label for="obs">Observaciones</label>
                            <input type="text" name="obs" class="form-control" value="{{ old('obs') }}">
                        </div>
                        <div class="form-group">
                            <label for="activo">Activo</label>
                            <select name="activo" id="activo" class="form-control">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-12">                            
                            <button type="submit" class="btn btn-primary mt-3">Agregarr</button>
                                                
                            <a href="{{ route('emisiones.index') }}" class="btn btn-secondary mt-3 ms-3">Cancelar</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>