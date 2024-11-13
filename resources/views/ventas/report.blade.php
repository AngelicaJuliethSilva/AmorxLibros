@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reporte de Ventas</h2>

        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>

        <!-- Verificación si no hay ventas -->
        @if($ventas->isEmpty())
            <div class="alert alert-warning">
                No se encontraron ventas en el rango de fechas seleccionado.
            </div>
        @else
            <!-- Tabla con los resultados -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Total Venta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->cliente }} {{ $venta->cliente_apellido }}</td>
                            <td>{{ \Carbon\Carbon::parse($venta->fecha_de_venta)->format('d-m-Y') }}</td>
                            <td>{{ $venta->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

