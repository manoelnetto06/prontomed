<?php

use Illuminate\Database\Seeder;

class AgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agendamentos')->insert([
            'data' => '20200106',
            'paciente_id' => 1
                 ]);

        DB::table('agendamentos')->insert([
            'data' => '20200206',
            'paciente_id' => 1
                ]);

        DB::table('agendamentos')->insert([
            'data' => '20200306',
            'paciente_id' => 1
                    ]);

        DB::table('agendamentos')->insert([
            'data' => '20210215',
            'paciente_id' => 2
                ]);

        DB::table('agendamentos')->insert([
            'data' => '20210318',
            'paciente_id' => 2
                    ]);

        DB::table('agendamentos')->insert([
            'data' => '20210118',
            'paciente_id' => 3
                    ]);

        DB::table('agendamentos')->insert([
            'data' => '20180118',
            'paciente_id' => 4
                    ]);

        DB::table('agendamentos')->insert([
            'data' => '20190105',
            'paciente_id' => 4
                    ]);

        DB::table('agendamentos')->insert([
            'data' => '20200920',
            'paciente_id' => 5
                    ]);
    }
}
