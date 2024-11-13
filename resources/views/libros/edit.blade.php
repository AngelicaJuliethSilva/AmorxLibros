@extends('layouts.app')

@section('content')
    <h1>Editar Precio y Cantidad del Libro</h1>

    <form action="{{ route('libros.update', $libro->id_libro) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio', $libro->precio) }}" step="0.01" required>
        </div>

        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $libro->cantidad) }}" required>
        </div>

        <button type="submit">Guardar Cambios</button>
        <a href="{{ route('libros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection