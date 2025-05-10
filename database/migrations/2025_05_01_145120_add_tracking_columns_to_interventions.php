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
        Schema::table('interventions', function (Blueprint $table) {
            // Ajout des dates de début et de fin de l'intervention
            $table->date('date_debut')->nullable()->after('date_intervention');
            $table->date('date_fin')->nullable()->after('date_debut');

            // Ajout des quantités utilisées
            $table->float('quantite_eau_utilisee')->nullable()->after('description');
            $table->float('quantite_engrais')->nullable()->after('quantite_eau_utilisee');
            $table->float('quantite_pesticide')->nullable()->after('quantite_engrais');
            $table->float('quantite_semences')->nullable()->after('quantite_pesticide');
            $table->float('quantite_recolte')->nullable()->after('quantite_semences');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropColumn([
                'date_debut',
                'date_fin',
                'quantite_eau_utilisee',
                'quantite_engrais',
                'quantite_pesticide',
                'quantite_semences',
                'quantite_recolte'
            ]);
        });
    }
};
