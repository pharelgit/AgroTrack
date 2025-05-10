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
        Schema::rename('types_intervention', 'type_interventions'); // Renomme la table
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('type_interventions', 'types_intervention'); // Reviens au nom original en cas de rollback
    }
};
