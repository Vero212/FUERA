<style>
.label-negrita{
    font-weight: bold;    
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Unidades') }}
        </h2>
    </x-slot>
    {{-- {{ dd($unidad) }} --}}
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

                    <form action="{{ route('unidades.update', $unidad->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="form-group">
                            <label class="label-negrita" for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $unidad->nombre) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="desc">Descripción</label>
                            <input type="text" name="desc" class="form-control" value="{{ old('desc', $unidad->desc) }}">
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="obs">Observaciones</label>
                            <input type="text" name="obs" class="form-control" value="{{ old('obs', $unidad->obs) }}">
                        </div>
                        <div class="form-group">
                            <label class="label-negrita" for="activa">Activo</label>
                            <select name="activo" id="activa" class="form-control">
                                <option value="1" {{ $unidad->activa == 1 ? 'selected' : '' }}>Activa</option>
                                <option value="0" {{ $unidad->activa == 0 ? 'selected' : '' }}>Inactiva</option>
                            </select>
                        </div>
                        <div class="col-md-12">                            
                            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                                                
                            <a href="{{ route('unidades.index') }}" class="btn btn-secondary mt-3 ms-3">Cancelar</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>