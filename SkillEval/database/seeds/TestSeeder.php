<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'type_id'    => 1,
            'moment'     => 'Inicial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'moment'     => 'Inicial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 1,
            'moment'     => 'Intermédio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'moment'     => 'Intermédio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 1,
            'moment'     => 'Final',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'moment'     => 'Final',
            'created_at' => now(),
            'updated_at' => now()
        ]);


//        factory(App\Test::class, 6)->create();
    }
}
