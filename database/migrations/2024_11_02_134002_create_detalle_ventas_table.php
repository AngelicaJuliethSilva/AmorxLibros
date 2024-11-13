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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id('id_detalle');
            $table->integer('cantidad');
            $table->unsignedBigInteger('id_libro_venta');
            $table->unsignedBigInteger('id_venta'); 
            $table->foreign('id_libro_venta')->references('id_libro')->on('libros')->onDelete('cascade');
            $table->foreign('id_venta')->references('id_venta')->on('ventas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
