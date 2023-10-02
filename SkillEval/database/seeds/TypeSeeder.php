<?php

use Illuminate\Database\Seeder;

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
            'type' => 'Tecnico',
            'created_at' => now(),
            'updated_at' => now()
          ]);
    
          DB::table('types')->insert([
            'type' => 'Psiquico',
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}
