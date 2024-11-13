<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Libro;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::all();
        $ventas->each(function ($venta) {
            $venta->fecha_de_venta = \Carbon\Carbon::parse($venta->fecha_de_venta);
        });
        return view('ventas.index', compact('ventas'));
    }

    // Mostrar el formulario para crear una venta
    public function create()
    {
        $clientes = Cliente::all();
        $libros = Libro::all(); 
        return view('ventas.create', compact('clientes', 'libros'));
    }

    // Guardar una nueva venta
    public function store(Request $request)
    {
        $request->validate([
        'id_cliente_venta' => 'required|exists:clientes,id_cliente',
        'libro_id' => 'required|array',
        'libro_id.*' => 'exists:libros,id_libro',
        'cantidad' => 'required|array',
        'cantidad.*' => 'integer|min:1',
        ]);
       
            // Inicializar el total de la venta
         $total = 0;

        // Calcular el total sumando el precio de cada libro por su cantidad
        foreach ($request->libro_id as $index => $libroId) {
        $libro = Libro::findOrFail($libroId); // Obtener el libro
        $cantidad = $request->cantidad[$index];
        $total += $libro->precio * $cantidad; // Sumar al total
    }

        $venta = Venta::create([
        'id_cliente_venta' => $request->id_cliente_venta,
        'total' => $total,
            ]);
        
        // Guardar cada detalle de la venta en la tabla detalle_ventas
        foreach ($request->libro_id as $index => $libroId) {
        $cantidad = $request->cantidad[$index];

        // Crear un registro en detalle_ventas para cada libro y su cantidad
        \App\Models\DetalleVenta::create([
            'id_libro_venta' => $libroId,  // Relacionar con el libro
            'cantidad' => $cantidad,       // La cantidad seleccionada
            'id_venta' => $venta->id_venta, // Relacionar con la venta creada
        ]);

        // Restar la cantidad vendida del inventario
        $libro = Libro::find($libroId);
        if ($libro && $libro->cantidad >= $cantidad) {
            $libro->cantidad -= $cantidad;  // Resta la cantidad vendida
            $libro->save();
        } else {
            return redirect()->route('ventas.index')->with('error', 'No hay suficiente stock para el libro: ' . $libro->titulo);
        }

        // Calcular el total de la venta
        $total += $libro->precio * $cantidad;

        }
   
            

         return redirect()->route('ventas.create')->with('success', 'Venta registrada exitosamente.');
    }

   

    // Editar una venta
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        return view('ventas.edit', compact('venta', 'clientes'));
    }

    // Actualizar una venta
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_cliente_venta' => 'required|exists:clientes,id_cliente',
            'fecha_venta' => 'required|date',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());
        return redirect()->route('ventas.index');
    }


    // Eliminar una venta
    public function destroy($id)
    {
        Venta::destroy($id);
        return redirect()->route('ventas.index');
    }
}
