<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Mostrar el formulario para crear un cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un nuevo cliente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'direccion' => 'required|string|max:100',
            'correo_electronico' => 'required|email|max:50',
            'celular' => 'required|integer',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente');
    }

    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Editar un cliente
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'direccion' => 'required|string|max:100',
            'correo_electronico' => 'required|email|max:50',
            'celular' => 'required|integer',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index');
    }

    // Eliminar un cliente
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('clientes.index');
    }
}
