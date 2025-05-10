<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter nom, prenom et statut
            $table->string('nom')->nullable()->after('id');
            $table->string('prenom')->nullable()->after('nom');
            $table->string('statut')->default('actif')->after('email');
        });

        // Ensuite, via un seeder ou manuellement, tu peux transférer les anciens `name` vers `nom`
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nom', 'prenom', 'statut']);
        });
    }
};
