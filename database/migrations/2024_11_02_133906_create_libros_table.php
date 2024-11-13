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
        Schema::create('libros', function (Blueprint $table) {
            $table->id('id_libro');
            $table->string('titulo', 50);
            $table->bigInteger('isbn')->unique();
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad')->default(0);
            $table->timestamp('load_date')->useCurrent();
            $table->timestamp('update_date')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
