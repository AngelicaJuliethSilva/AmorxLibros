
<!-- resources/views/ventas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Ventas</h1>
    <a href="{{ route('ventas.create') }}">Crear una nueva venta</a>
    
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
                    <a href="{{ route('detalles.index', ['id' => $venta->id_venta]) }}">Ver detalles</a>
                    <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellido }}</td>              
                    <td>{{ $venta->fecha_de_venta->format('d-m-Y H:i') }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>
                        <a href="{{ route('detalles.index', ['id' => $venta->id_venta]) }}">Ver detalles</a>
                        <a href="{{ route('ventas.show', $venta->id_venta) }}">Ver</a>
                        <a href="{{ route('ventas.edit', $venta->id_venta) }}">Editar</a>
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
