<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('variedad', 80)->nullable();
            $table->string('formato', 60)->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('imagen', 255)->nullable();
            $table->boolean('disponible')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
