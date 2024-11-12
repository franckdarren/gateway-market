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
        Schema::create('compte_startups', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_creation');
            $table->string('activite_principale');
            $table->string('email');
            $table->string('phone');
            $table->integer('solde');


            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte_startups');
    }
};
