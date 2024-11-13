<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCategoriaToLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->bigInteger('id_categoria')->unsigned(); // Agregar columna
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade'); // Agregar clave foránea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']); // Eliminar la clave foránea
            $table->dropColumn('id_categoria'); // Eliminar la columna
        });
    }
}
