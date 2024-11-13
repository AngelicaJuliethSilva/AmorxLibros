
<!-- resources/views/clientes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}">Crear un nuevo cliente</a>
        <!-- Formulario para generar el reporte de clientes frecuentes -->
        <form action="{{ route('clientes.report') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label for="fecha_fin">Fecha de fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Generar Reporte de Clientes Frecuentes</button>
            </div>
        </div>
    </form>
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
