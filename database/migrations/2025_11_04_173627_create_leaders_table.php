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
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru')->nullable();
            $table->string('title_tj')->nullable();
            $table->string('title_en')->nullable();
            $table->string('position_ru')->nullable();
            $table->string('position_tj')->nullable();
            $table->string('position_en')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_tj');
            $table->text('text_en')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_days')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaders');
    }
};
