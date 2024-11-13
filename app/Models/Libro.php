<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    const CREATED_AT = 'load_date';
    const UPDATED_AT = 'update_date';
    
    protected $table = 'libros';

    protected $primaryKey = 'id_libro';

    protected $fillable = [
        'titulo',
        'id_categoria',
        'isbn',
        'precio',
        'cantidad',
        'autor_id',
        'load_date',
        'update_date',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function detallesVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_libro_venta');
    }
    public function autores()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'libro_venta', 'id_venta', 'id_libr')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }
}

