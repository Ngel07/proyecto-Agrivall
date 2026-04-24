<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido');
            $table->string('estado', 30);
            $table->decimal('precio_pedido', 10, 2);
            $table->string('nombre_cliente', 120);
            $table->string('tlf_cliente', 30)->nullable();
            $table->string('email_cliente', 120)->nullable();
            $table->string('direccion_envio', 255)->nullable();
            $table->string('metodo_pago', 40)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
