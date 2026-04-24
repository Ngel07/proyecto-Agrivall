<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semanas_casilla', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('anio');
            $table->unsignedTinyInteger('numero_sem');
            $table->string('descriptor', 200)->nullable();
            $table->string('estado', 30);
            $table->decimal('precio', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['anio', 'numero_sem']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semanas_casilla');
    }
};
