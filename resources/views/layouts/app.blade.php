

<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav>
        <ul>
            <li><a href="{{ route('libros.index') }}">Libros</a></li>
            <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
            <li><a href="{{ route('autores.index') }}">Autores</a></li>
            <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li><a href="{{ route('ventas.index') }}">Ventas</a></li>
            
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
