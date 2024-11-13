
<!-- resources/views/ventas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Ventas</h1>
    <a href="{{ route('ventas.create') }}">Crear una nueva venta</a>
    
    <form action="{{ route('ventas.report') }}" method="GET" class="mb-4">
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
            <button type="submit" class="btn btn-primary mt-4">Generar Reporte</button>
        </div>
    </div>
    </form>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Fecha de Venta</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>              
                    <td>{{ $venta->fecha_de_venta->format('d-m-Y H:i') }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>
                        <a href="{{ route('detalle_venta.index', $venta->id_venta) }}">Ver detalles</a>
                        <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
