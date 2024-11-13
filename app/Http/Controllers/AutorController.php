<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    // Mostrar todos los autores
    public function index()
    {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    // Mostrar el formulario para crear un autor
    public function create()
    {
        return view('autores.create');
    }

    // Guardar un nuevo autor
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'nacionalidad' => 'required|string|max:50',
            'biografia' => 'required|string',
        ]);

        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor creado exitosamente');    
    }

    // Mostrar un autor específico
    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.show', compact('autor'));
    }

    // Editar un autor
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    // Actualizar un autor
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'nacionalidad' => 'required|string|max:50',
            'biografia' => 'required|string',
        ]);

        $autor = Autor::findOrFail($id);
        $autor->update($request->all());
        return redirect()->route('autores.index');
    }

    // Eliminar un autor
    public function destroy($id)
    {
        Autor::destroy($id);
        return redirect()->route('autores.index');
    }
}
