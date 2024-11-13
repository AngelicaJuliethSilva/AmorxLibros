<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_ventas';

    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'cantidad',
        'id_libro_venta',
        'id_venta',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro_venta');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
