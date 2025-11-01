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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            // Многоязычные заголовки
            $table->string('title_ru')->nullable();
            $table->string('title_tj');
            $table->string('title_en')->nullable();
            $table->string('url')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_tj');
            $table->text('text_en')->nullable();
            $table->boolean('status')->default(true);// Статус
            $table->timestamps();
            $table->unique('url'); // Уникальность URL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
