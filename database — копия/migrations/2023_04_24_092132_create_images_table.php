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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Путь к изображению
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');  // Привязка к галерее
            $table->timestamps();
            $table->index('gallery_id');     // Индекс для быстрого поиска по галерее
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
