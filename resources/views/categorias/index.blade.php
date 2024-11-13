
<!-- resources/views/categorias/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Categorías</h1>
    <a href="{{ route('categorias.create') }}">Crear una nueva categoría</a>
    <table>
        <thead>
            <tr>
                <th>Nombre de Categoría</th>
                <th>Libro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->categoria }}</td>
                    <td> </td>
                    <td>
                        
                        <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" style="display:inline;">
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
