@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reporte de Clientes Frecuentes</h2>

        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-4">Volver</a>

        <!-- Verificación si no hay clientes -->
        @if($clientesFrecuentes->isEmpty())
            <div class="alert alert-warning">
                No se encontraron clientes en el rango de fechas seleccionado.
            </div>
        @else
            <!-- Tabla con los resultados -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Cliente</th>
                        <th>Cantidad de Compras</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientesFrecuentes as $index => $cliente)
                        <tr>
                            <td>{{ $index + 1 }}</td>  <!-- Posición en el ranking -->
                            <td>{{ $cliente->cliente }} {{ $cliente->cliente_apellido }}</td>
                            <td>{{ $cliente->numero_compras }}</td>  <!-- Número de ventas -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

