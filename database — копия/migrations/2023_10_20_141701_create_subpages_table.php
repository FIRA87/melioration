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
        Schema::create('sub_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');// Связь с главной страницей
            // Многоязычные поля
            $table->string('title_ru')->nullable();
            $table->string('title_tj')->nullable();
            $table->string('title_en')->nullable();
            $table->string('url')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_tj');
            $table->text('text_en')->nullable();

            // Статус и сортировка
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
            $table->index(['page_id', 'sort']);    // Индекс для сортировки
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menu_items');
    }
};
