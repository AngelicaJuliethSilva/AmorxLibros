@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Registrar Nueva Venta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_cliente_venta">Cliente</label>
                <select name="id_cliente_venta" id="id_cliente_venta" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div id="libros-container">
            <div class="libro-item">
                <label for="libro_id[]">Libro</label>
                <select name="libro_id[]" required>
                    @foreach($libros as $libro)
                        <option value="{{ $libro->id_libro }}">{{ $libro->titulo }}</option>
                    @endforeach
                </select>

                <label for="cantidad[]">Cantidad</label>
                <input type="number" name="cantidad[]" min="1" required>
            </div>
            </div>
            
            <button type="button" id="add-book">Agregar otro libro</button>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

        <script>
        document.getElementById('add-book').addEventListener('click', function() {
            const container = document.getElementById('libros-container');
            const newBook = document.querySelector('.libro-item').cloneNode(true);
            container.appendChild(newBook);
        });
        </script>

    </div>
@endsection
