@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalle de la Venta</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Libro</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Cliente</th>
                    <th>Total Venta</th>
                    <th>Fecha de Venta</th>
                </tr>
                <a href="{{ route('ventas.index') }}" class="btn btn-primary mb-3">Volver</a>
            </thead>
            <tbody>
                @foreach ($detalleVentas as $detalle)
                    <tr>
                        <td>{{ $detalle->libro }}</td>
                        <td>{{ $detalle->precio }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $detalle->cliente }} {{ $detalle->cliente_apellido }}</td>
                        <td>{{ $detalle->total }}</td>
                        <td>{{ \Carbon\Carbon::parse($detalle->fecha_de_venta)->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
