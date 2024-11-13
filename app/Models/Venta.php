<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';

    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'id_cliente_venta',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_venta', 'id_cliente');
    }

    public function detallesVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_venta', 'id_venta', 'id_libro')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    protected $dates = ['fecha_de_venta'];
}
