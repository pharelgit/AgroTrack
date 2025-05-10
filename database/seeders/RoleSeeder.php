<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // désactiver les contraintes
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // réactiver les contraintes

        Role::insert([
            ['nom' => 'Administrateur', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Agriculteur', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

