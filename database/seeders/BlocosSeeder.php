<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocosSeeder extends Seeder
{
    public function run()
    {
        DB::table('blocos')->insert([
            ['nome' => 'Bloco A', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco B', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco C', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco D', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco E', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco F', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bloco G', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
