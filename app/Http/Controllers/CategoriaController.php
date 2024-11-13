<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    // Mostrar el formulario para crear una categoría
    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'categoria' => 'required|string|max:50', // Validación para el campo 'categoria'
        ]);

        // Crear la nueva categoría en la base de datos
        Categoria::create([
            'categoria' => $request->categoria,
        ]);

        // Redirigir a una página de éxito o la lista de categorías
        return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
    }

    // Mostrar una categoría específica
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    // Editar una categoría
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria', 'libros'));
    }

    // Actualizar una categoría
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria' => 'required|string|max:50',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        return redirect()->route('categorias.index');
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('categorias.index');
    }
}
