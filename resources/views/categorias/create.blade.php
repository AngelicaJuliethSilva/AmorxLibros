@extends('layouts.app')  <!-- Extiende tu layout si tienes uno -->

@section('content')
    <div class="container">
        <h1>Crear Categoría</h1>
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf <!-- Directiva para proteger el formulario contra CSRF -->
            
            <!-- Campo para el nombre de la categoría -->
            <div class="form-group">
                <label for="categoria">Nombre de la Categoría</label>
                <input type="text" id="categoria" name="categoria" class="form-control" value="{{ old('categoria') }}" required>
                
                @error('categoria')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Guardar Categoría</button>
        </form>
    </div>
@endsection
