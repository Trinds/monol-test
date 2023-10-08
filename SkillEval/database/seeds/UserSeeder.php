<?php

use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;


class UserSeeder extends Seeder
{
    use Notifiable;
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
