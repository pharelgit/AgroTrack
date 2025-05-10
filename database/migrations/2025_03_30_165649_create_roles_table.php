<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('nom')->unique(); // Rôle unique (ex : Administrateur, Agriculteur)
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
