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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('nom_projet');
            $table->string('description_projet');
            $table->integer('montant');
            $table->integer('nbre_mois_remboursement');
            $table->integer('nbre_mois_grace');
            $table->integer('taux_interet');
            $table->string('url_business_plan')->nullable();
            $table->string('url_etude_risque')->nullable();
            $table->integer('van');
            $table->float('ir');
            $table->float('tri');
            $table->float('krl');

            $table->foreignId('compte_startup_id')->constrained()->onDelete('cascade'); // clé étrangère obligatoire
            $table->foreignId('compte_investisseur_id')->nullable()->constrained()->onDelete('set null'); // clé étrangère optionnelle


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
