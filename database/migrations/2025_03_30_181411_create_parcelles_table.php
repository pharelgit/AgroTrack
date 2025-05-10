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
        Schema::create('parcelles', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('nom')->nullable(false);
            $table->float('superficie')->nullable(false);
            $table->string('type_de_culture')->nullable(false);
            $table->date('date_de_plantation')->nullable(false);
            $table->foreignId('statut_id') // Clé étrangère vers la table statuts
            ->constrained('statuts')
                ->onDelete('restrict');
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelles');
    }
};
