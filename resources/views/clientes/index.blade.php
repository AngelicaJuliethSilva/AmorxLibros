
<!-- resources/views/clientes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}">Crear un nuevo cliente</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Celular</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellido }}</td>
                    <td>{{ $cliente->correo_electronico }}</td>
                    <td>{{ $cliente->celular }}</td>
                    <td>
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" style="display:inline;">
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
