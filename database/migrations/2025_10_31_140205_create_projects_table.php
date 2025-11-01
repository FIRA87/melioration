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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru')->nullable();
            $table->string('title_tj');
            $table->string('title_en')->nullable();
            $table->string('slug');
            $table->string('image');
            $table->text('text_ru')->nullable();
            $table->text('text_tj');
            $table->text('text_en')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
