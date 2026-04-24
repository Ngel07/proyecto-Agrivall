<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts_blog', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('noticia');
            $table->date('fecha_public');
            $table->string('imagen', 255)->nullable();
            $table->foreignId('tipo_post_id')->constrained('tipos_post')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('tipo_post_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts_blog');
    }
};
