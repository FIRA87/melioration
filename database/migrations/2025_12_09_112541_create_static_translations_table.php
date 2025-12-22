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
        Schema::create('static_translations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // например: 'show_all_responsibilities'
            $table->text('value_ru');
            $table->text('value_en');
            $table->text('value_tj');
            $table->string('group')->nullable(); // для группировки: 'buttons', 'titles' и т.д.
            $table->text('description')->nullable(); // описание для админа
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_translations');
    }
};
