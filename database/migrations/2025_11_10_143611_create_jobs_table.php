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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->string('title_ru')->nullable();
            $table->string('title_tj');
            $table->string('title_en')->nullable();
            $table->string('slug')->nullable()->unique();

            // основное изображение вакансии (опционально)
            $table->string('image')->nullable();

            // описания и требования
            $table->text('description_ru')->nullable();
            $table->text('description_tj')->nullable();
            $table->text('description_en')->nullable();

            $table->text('requirements_ru')->nullable();
            $table->text('requirements_tj')->nullable();
            $table->text('requirements_en')->nullable();

            // дополнительные поля
            $table->string('location')->nullable();
            $table->string('salary')->nullable();

            // дата публикации (опционально показывать в диапазоне)
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // attachments: json array of files (pdfs, other docs)
            $table->json('attachments')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
