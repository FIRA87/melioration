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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // Многоязычные названия
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_tj');
            $table->string('category_slug')->unique();    // Уникальный слаг
            // Статус и позиция
            $table->boolean('status')->default(true);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
            $table->index('position');    // Индекс по позиции для сортировки
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
