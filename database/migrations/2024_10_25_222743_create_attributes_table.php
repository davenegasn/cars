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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->boolean('sold')->default(false);
            $table->string('price')->nullable();
            
            $table->string('condition')->nullable();
            $table->string('address')->nullable();
            $table->string('owners')->nullable();
            $table->string('traccion')->nullable();
            $table->string('tipo_transmision')->nullable();
            
            $table->string('asientos')->nullable();
            $table->string('kilometraje')->nullable();
            $table->string('velocidades')->nullable();
            $table->string('motor')->nullable();
            $table->string('tipo_combustible')->nullable();
            $table->string('carroceria')->nullable();

            $table->string('_video_youtube')->nullable();
            $table->string('_video_media')->nullable();

            $table->foreignId('year_id')->nullable()->constrained('years')->cascadeOnDelete();;
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
