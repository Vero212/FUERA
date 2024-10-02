<style>
.label-negrita{
    font-weight: bold;    
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Tipos') }}
        </h2>
    </x-slot>
    {{-- {{ dd($tipo) }} --}}
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

                    <form action="{{ route('tipos.update', $tipo->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Usamos PUT para la actualizaciï¿½n -->
                        
                        <div class="form-group">
                            <label class="label-negrita" for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $tipo->nombre) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="desc">Descripción</label>
                            <input type="text" name="desc" class="form-control" value="{{ old('desc', $tipo->desc) }}">
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="obs">Observaciones</label>
                            <input type="text" name="obs" class="form-control" value="{{ old('obs', $tipo->obs) }}">
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="activo">Activo</label>
                            <select name="activo" id="activo" class="form-control">
                                <option value="1" {{ $tipo->activo == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $tipo->activo == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>