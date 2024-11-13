<!-- resources/views/autores/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Autores</h1>
    <a href="{{ route('autores.create') }}">Crear un nuevo autor</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Biografía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autores as $autor)
                <tr>
                    <td>{{ $autor->nombre }}</td>
                    <td>{{ $autor->nacionalidad }}</td>
                    <td>{{ $autor->biografia }}</td>
                    <td>
                        <form action="{{ route('autores.destroy', $autor->id_autor) }}" method="POST" style="display:inline;">
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
