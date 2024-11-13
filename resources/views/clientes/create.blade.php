@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Cliente</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required>
            </div>

            <div class="form-group">
                <label for="correo_electrónico">Correo Electrónico</label>
                <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" value="{{ old('correo_electronico') }}" required>
            </div>

            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="number" name="celular" id="celular" class="form-control" value="{{ old('celular') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
