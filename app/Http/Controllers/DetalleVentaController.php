<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index($id)
    {
        // Obtener los detalles de la venta con cliente y libros asociados
        $detalleVentas = \DB::table('detalle_ventas')
            ->join('libros', 'detalle_ventas.id_libro_venta', '=', 'libros.id_libro')
            ->join('ventas', 'detalle_ventas.id_venta', '=', 'ventas.id_venta')
            ->join('clientes', 'ventas.id_cliente_venta', '=', 'clientes.id_cliente')
            ->where('detalle_ventas.id_venta', $id)
            ->select(
                'detalle_ventas.cantidad',
                'libros.titulo as libro',
                'libros.precio',
                'clientes.nombre as cliente',
                'clientes.apellido as cliente_apellido',
                'ventas.total',
                'ventas.fecha_de_venta',
                'ventas.id_venta'
            )
            ->get();

        // Si no hay detalles para esa venta, redirigir con un mensaje de error
        if ($detalleVentas->isEmpty()) {
            return redirect()->route('ventas.index')->with('error', 'No se encontraron detalles para esta venta.');
        }

        // Pasar los datos a la vista 'detalles.index'
        return view('detalles.index', compact('detalleVentas'));
    }
}
