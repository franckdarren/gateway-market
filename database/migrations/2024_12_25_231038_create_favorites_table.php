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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compte_investisseur_id');
            $table->unsignedBigInteger('offre_id');
            $table->timestamps();

            $table->foreign('compte_investisseur_id')->references('id')->on('compte_investisseurs')->onDelete('cascade');
            $table->foreign('offre_id')->references('id')->on('offres')->onDelete('cascade');
            $table->unique(['compte_investisseur_id', 'offre_id']); // Un investisseur ne peut pas ajouter la même offre plusieurs fois
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
