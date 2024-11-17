<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'isbn' => 'required|string|max:20',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ]);
    
        try {
            // Llamar al procedimiento almacenado para registrar el libro
            DB::statement('CALL RegistrarLibro(?, ?, ?, ?, ?)', [
                $request->titulo,
                $request->isbn,
                $request->precio,
                $request->cantidad,  // Solo un valor de cantidad
                $request->id_categoria,
            ]);
        
            // Redirigir con mensaje de éxito
            return redirect()->route('libros.index')->with('success', 'Libro registrado exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores
            return redirect()->route('libros.index')->with('error', 'Hubo un problema al registrar el libro: ' . $e->getMessage());
        }
        
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

    try {
        // Llamar al procedimiento almacenado para actualizar el libro
        DB::statement('CALL ActualizarLibro(?, ?, ?)', [
            $id,
            $request->precio,
            $request->cantidad,
        ]);

        return redirect()->route('libros.index')->with('success', 'Precio actualizado exitosamente.');
        } catch (\Exception $e) {
        // Manejar errores
        return redirect()->route('libros.index')->with('error', 'Hubo un problema al actualizar el libro: ' . $e->getMessage());
        }
    }

    // Eliminar un libro
    public function destroy($id)
    {
        Libro::destroy($id);
        return redirect()->route('libros.index');
    }
}
