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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->foreignId('parcelle_id')
            ->constrained('parcelles')
                ->onDelete('cascade');
            $table->foreignId('type_intervention_id')
            ->constrained('types_intervention')
                ->onDelete('restrict');
            $table->date('date_intervention')->nullable(false);
            $table->text('description')->nullable();
            $table->float('quantite_produit_utilise')->nullable();
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
