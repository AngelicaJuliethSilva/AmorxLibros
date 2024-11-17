<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Libro;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

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
        // Validar los datos del formulario
        $request->validate([
            'id_cliente_venta' => 'required|exists:clientes,id_cliente',
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id_libro',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
        ]);
    
        try {
            // Convertir los arrays de IDs y cantidades a formato JSON
            $libroIds = json_encode($request->libro_id);
            $cantidades = json_encode($request->cantidad);
    
            // Llamar al procedimiento almacenado para registrar la venta
            DB::statement('CALL RegistrarVenta(?, ?, ?)', [
                $request->id_cliente_venta,
                $libroIds,
                $cantidades,
            ]);
    
            // Obtener la venta que se acaba de registrar
            $venta = Venta::latest()->first();
    
            // Redirigir con mensaje de éxito
            return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
        } catch (\Exception $e) {
            // Manejar errores y redirigir con mensaje de error
            return redirect()->route('ventas.index')->with('error', 'Hubo un problema al registrar la venta: ' . $e->getMessage());
        }
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

    public function ObtenerReporteVentas(Request $request)
    {
        // Validar las fechas de inicio y fin
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $fechaInicio = Carbon::parse($request->fecha_inicio)->format('Y-m-d H:i:s');
        $fechaFin = Carbon::parse($request->fecha_fin)->format('Y-m-d H:i:s');
    
        // Llamar al procedimiento almacenado
        $ventas = collect(DB::select('CALL ObtenerReporteVentas(?, ?)', [
            $request->fecha_inicio,
            $request->fecha_fin,
        ]));
    
        // Retornar el reporte a una vista
        return view('ventas.report', compact('ventas', 'request'));
    }

}
