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
        Schema::create('image_gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('images');

            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('wp_id')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_galleries');
    }
};
