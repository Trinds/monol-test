<?php

use Illuminate\Database\Seeder;

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
            'date'       =>  date('y-m-d'),
            'moment'     => 'Inicial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'date'       =>  date('y-m-d'),
            'moment'     => 'Inicial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 1,
            'date'       =>  date('y-m-d'),
            'moment'     => 'Intermédio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'date'       =>  date('y-m-d'),
            'moment'     => 'Intermédio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 1,
            'date'       =>  date('y-m-d'),
            'moment'     => 'Final',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tests')->insert([
            'type_id'    => 2,
            'date'       =>  date('y-m-d'),
            'moment'     => 'Final',
            'created_at' => now(),
            'updated_at' => now()
        ]);


//        factory(App\Test::class, 6)->create();
    }
}
