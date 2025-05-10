<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Supprime la colonne date_intervention de la table interventions.
     */
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn('date_intervention');
        });
    }

    /**
     * Reverse the migrations.
     * Ajoute la colonne date_intervention en cas de rollback.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->date('date_intervention')->nullable();
        });
    }
};
