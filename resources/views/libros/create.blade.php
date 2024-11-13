@extends('layouts.app')

@section('content')
    <h1>Registrar un nuevo libro</h1>

    <form action="{{ route('libros.store') }}" method="POST">
        @csrf

        <div>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
        </div>

        <div>
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" required>
        </div>

        <div>
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" step="0.01" required>
        </div>

        <div>
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}" required>
        </div>

        <div>
            <label for="id_categoria">Categoría</label>
            <select name="id_categoria" id="id_categoria" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                        {{ $categoria->categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="autor_id">Autor</label>
            <select name="autor_id" id="autor_id" required>
                @foreach($autores as $autor)
                    <option value="{{ $autor->id_autor }}" {{ old('autor_id') == $autor->id_autor ? 'selected' : '' }}>
                        {{ $autor->nombre }} {{ $autor->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Registrar Libro</button>
        <a href="{{ route('libros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

