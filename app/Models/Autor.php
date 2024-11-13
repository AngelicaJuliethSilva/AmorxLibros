<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autors';

    protected $primaryKey = 'id_autor';

    protected $fillable = [
        'nombre',
        'nacionalidad',
        'biografia',
    ];

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'autor_libro', 'id_autor', 'id_libro');
    }
}
