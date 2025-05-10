<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeInterventionSeeder extends Seeder
{
    public function run()
    {
        DB::table('type_interventions')->insert([
            ['nom' => 'Semis', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Arrosage', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Fertilisation', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Traitement', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Récolte', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
