<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use App\Models\Autor;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    // Mostrar todos los libros
    public function index()
    {
        $libros = Libro::all();
        return view('libros.index', compact('libros'));
    }

    // Mostrar el formulario para crear un libro
    public function create()
    {
        $categorias = Categoria::all();
        $autores = Autor::all();
        $autores = Autor::all();
        return view('libros.create', compact('categorias', 'autores'));
    }

    // Guardar un nuevo libro
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'isbn' => 'required|integer',
            'precio' => 'required|numeric',
            'cantidad' => 'nullable|integer',
            'id_categoria' => 'required|exists:categorias,id_categoria', // Relación con categorias
            'autor_id' => 'required|exists:autors,id_autor', // Relación con autores
        ]);

        Libro::create([
            'titulo' => $request->titulo,
            'isbn' => $request->isbn,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'id_categoria' => $request->id_categoria,
        ]);
        return redirect()->route('libros.index')->with('success', 'Libro registrado exitosamente.');
    }

    // Mostrar un libro específico
    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libros.show', compact('libro'));
    }

    // Mostrar el formulario para editar un libro
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        return view('libros.edit', compact('libro'));
    }

    // Actualizar un libro
    public function update(Request $request, $id)
    {
        $request->validate([
            'precio' => 'required|numeric',
            'cantidad' => 'nullable|integer',
        ]);

        $libro = Libro::findOrFail($id);
        $libro->update([
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
        ]);
        return redirect()->route('libros.index')->with('success', 'Precio actualizado exitosamente.');
    }

    // Eliminar un libro
    public function destroy($id)
    {
        Libro::destroy($id);
        return redirect()->route('libros.index');
    }
}
