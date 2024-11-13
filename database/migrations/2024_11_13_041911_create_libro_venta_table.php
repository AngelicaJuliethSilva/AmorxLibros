<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libro_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta');  // Asegúrate de usar el nombre correcto
            $table->unsignedBigInteger('id_libro');  // También asegúrate de que esta columna exista
            $table->integer('cantidad');
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');  // Referencia correcta
            $table->foreign('id_libro')->references('id_libro')->on('libros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_venta');
    }
};
