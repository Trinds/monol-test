<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CourseSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
