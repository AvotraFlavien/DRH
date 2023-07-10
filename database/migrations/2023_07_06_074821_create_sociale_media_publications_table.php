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
        Schema::create('sociale_media_publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_publication')->constrained('publications')->cascadeOnDelete();
            $table->foreignId('id_sociale_media_types')->constrained('sociale_media_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sociale_media_publications');
    }
};
