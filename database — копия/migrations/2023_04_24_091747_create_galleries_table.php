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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            // Многоязычные поля
            $table->string('title_ru')->nullable();
            $table->string('title_tj');
            $table->string('title_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_tj');
            $table->text('text_en')->nullable();
            $table->string('cover');  // Обложка
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
