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
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('titre');
            $table->string('auteur');
            $table->integer('anneePublication');
            $table->enum('status', ['Disponible', 'Emprunté', 'Réservé', 'Indisponible'])->default('disponible');
            $table->enum('type', ['Physique', 'Numérique', 'Audio'])->default('Physique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
