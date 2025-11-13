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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Basic', 'Standard', 'Premium']);
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->enum('status', ['Actif', 'Expiré', 'Suspendu']);
            $table->integer('limiteEmprunts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
