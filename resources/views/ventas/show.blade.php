@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalle de la Venta</h2>

        <div class="card">
            <div class="card-header">
                <h3>Venta #{{ $venta->id_venta }}</h3>
            </div>
            <div class="card-body">
                <!-- Datos del Cliente -->
                <p><strong>Cliente:</strong> {{ $cliente->nombre }} {{ $cliente->apellido }}</p>
                <p><strong>Fecha de Venta:</strong> {{ \Carbon\Carbon::parse($venta->fecha_de_venta)->format('d/m/Y') }}</p>

                <!-- Detalle de los Libros -->
                <h4>Libros Vendidos</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Libro</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venta->libros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->pivot->cantidad }}</td>
                                <td>${{ number_format($libro->precio, 2) }}</td>
                                <td>${{ number_format($libro->precio * $libro->pivot->cantidad, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total de la venta -->
                <h4>Total de la Venta: ${{ number_format($venta->total, 2) }}</h4>
            </div>
        </div>
    </div>
@endsection