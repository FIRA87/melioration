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
        Schema::create('page_images', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable'); // Creates imageable_type and imageable_id
            $table->string('image'); // Path to image file
            $table->unsignedInteger('sort_order')->default(0); // Sorting order
            $table->timestamps();
            
            // Index for better performance
            $table->index(['imageable_type', 'imageable_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_images');
    }
};
