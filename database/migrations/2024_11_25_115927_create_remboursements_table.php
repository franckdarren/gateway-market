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
        Schema::create('remboursements', function (Blueprint $table) {
            $table->id(); // ID principal
            $table->unsignedBigInteger('offre_id'); // Lien vers l'offre
            $table->unsignedBigInteger('compte_startup_id'); // Lien vers le compte de la startup
            $table->unsignedBigInteger('compte_investisseur_id'); // Lien vers le compte de l'investisseur
            $table->string('mois'); // Mois du remboursement
            $table->integer('capital_restant'); // Capital restant
            $table->integer('interet_du'); // Intérêt dû
            $table->integer('remboursement_capital'); // Remboursement du capital
            $table->integer('remboursement_interet'); // Remboursement de l'intérêt
            $table->integer('remboursement_total'); // Total remboursé (capital + intérêt)
            $table->integer('cumul_remboursement'); // Cumul des remboursements
            $table->timestamps(); // Colonnes created_at et updated_at

            // Déclaration des clés étrangères avec cascade
            $table->foreign('offre_id')->references('id')->on('offres')->onDelete('cascade');
            $table->foreign('compte_startup_id')->references('id')->on('compte_startups')->onDelete('cascade');
            $table->foreign('compte_investisseur_id')->references('id')->on('compte_investisseurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remboursements');
    }
};
