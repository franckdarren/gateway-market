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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('montant');
            $table->enum('type', ['depot', 'retrait', 'investissement', 'remboursement débit', 'remboursement crédit', 'remboursement ERREUR']);
            $table->string('description')->nullable();
            $table->string('compte_type');
            $table->unsignedBigInteger('compte_id');
            $table->string('mode_retrait')->nullable();
            $table->string('numero_compte')->nullable();
            $table->string('nom_compte')->nullable();
            $table->integer('frais')->nullable();
            $table->string('numero_transaction')->nullable();


            $table->string('statut')->default('En attente de traitement');

            $table->foreignId('offre_id')->nullable()->constrained()->onDelete('set null'); // clé étrangère optionnelle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
