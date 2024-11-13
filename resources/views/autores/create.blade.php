@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Autor</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('autores.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre del Autor</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}" required>
            </div>

            <div class="form-group">
                <label for="biografia">Biografia</label>
                <input type="text" name="biografia" id="biografia" class="form-control" value="{{ old('biografia') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Autor</button>
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
