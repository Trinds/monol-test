<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type' => 'Técnico',
            'created_at' => now(),
            'updated_at' => now()
          ]);
    
          DB::table('types')->insert([
            'type' => 'Psicotécnico',
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}
