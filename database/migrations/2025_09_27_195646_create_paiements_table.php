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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            // $table->decimal('montant', 8, 2);
            $table->decimal('montant');
            $table->datetime('datePaiement');
            $table->enum('moyenPaiement', ['Carte', 'PayPal', 'MobileMoney', 'Stripe']);
            $table->enum('statut', ['Réussi', 'Échoué', 'EnAttente']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
