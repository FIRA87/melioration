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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            // Внешние ключи с каскадным удалением
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Многоязычные заголовки
            $table->string('title_ru')->nullable();
            $table->string('title_tj');
            $table->string('title_en')->nullable();

            // Уникальный слаг для URL
            $table->string('slug')->unique();

            // Обложка новости
            $table->string('image')->default('404.jpg');

            // Многоязычный контент
            $table->text('news_details_ru');
            $table->text('news_details_tj');
            $table->text('news_details_en');

            // Флаги
            $table->boolean('top_slider')->default(false); // в топ-слайдер
            $table->date('publish_date')->nullable();     // дата публикации
            $table->boolean('status')->default(true);     // 1 = опубликовано
            $table->unsignedBigInteger('views')->default(0); // счётчик просмотров
            $table->timestamps();

            // Индексы для ускорения поиска
            $table->index('publish_date');
            $table->index('status');
            $table->index('top_slider');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
