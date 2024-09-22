<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->float('total');
            $table->date('fecha');
            $table->string('estado');
            $table->timestamps();
        });

        DB::table('ventas')->insert([
            ['id_cliente' => 1, 'total' => 100.00, 'fecha' => now(), 'estado' => 'completado'],
            // Más datos si es necesario
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};