<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuts')->insert([
            ['nom' => 'En culture', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Récoltée', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'En jachère', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
