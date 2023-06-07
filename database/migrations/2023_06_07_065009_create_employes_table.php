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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();

            $table->string("nom")->nullable(true);
            $table->string("prenom")->nullable(true);
            $table->bigInteger("matricule")->nullable(true)->unique();
            $table->string("poste")->nullable(true);
            $table->date("date_naissance")->nullable(true);
            $table->integer("telephone")->nullable(true)->unique();
            $table->string("adresse")->nullable(true);
            $table->string("photo")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
