<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert(
            [
                'name' => 'Técnico/a Especialista em Gestão de Redes e Sistemas Informáticos',
                'abbreviation' => 'GRSI',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,

            ]
        );
        DB::table('courses')->insert(
            [
                'name' => 'Técnico/a Especialista em Tecnologia Mecatrónica',
                'abbreviation' => 'TTM',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,

            ]
        );

        DB::table('courses')->insert(
            [
                'name' => 'Técnico/a Especialista em Gestão e Controlo de Energia',
                'abbreviation' => 'GCE',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );


        DB::table('courses')->insert(
            [
                'name' => 'Técnico/a Especialista em Automação Robótica e Controlo Industrial',
                'abbreviation' => 'ARCI',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );

        DB::table('courses')->insert(
            [
                'name' => 'Técnico/a Especialista em Tecnologias e Programação de Sistemas de Informação',
                'abbreviation' => 'TPSI',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
            );

    }
}
