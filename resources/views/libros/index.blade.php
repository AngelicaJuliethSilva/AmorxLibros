
<!-- resources/views/libros/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Libros</h1>
    <a href="{{ route('libros.create') }}">Crear un nuevo libro</a>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>ISBN</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($libros as $libro)
                <tr>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->isbn }}</td>
                    <td>{{ $libro->precio }}</td>
                    <td>{{ $libro->cantidad }}</td>
                    <td>
                        <a href="{{ route('libros.edit', $libro->id_libro) }}">Editar Precio/Cantidad</a>
                        <form action="{{ route('libros.destroy', $libro->id_libro) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

        </tbody>
    </table>
@endsection
