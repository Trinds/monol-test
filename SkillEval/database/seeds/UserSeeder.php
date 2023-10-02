<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 7)->create()->each(function ($user) {
            $user->roles()->attach(App\Role::all()->random()->id);
        });
    }
}
