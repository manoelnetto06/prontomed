<?php

use Illuminate\Database\Seeder;

class ConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consultas')->insert([
            'data' => '20200106',
            'atendimento' => 'O paciente apresentou um caso de hemorragia moderada.',
            'paciente_id' => 1
                 ]);

        DB::table('consultas')->insert([
            'data' => '20200306',
            'atendimento' => 'O paciente entrou para o quadro de espera para atendimento.',
            'paciente_id' => 1
                ]);

        DB::table('consultas')->insert([
            'data' => '20200506',
            'atendimento' => 'Foi recomendado a prática de exercícios físicos e alimentação regrada.',
            'paciente_id' => 1
                ]);

        DB::table('consultas')->insert([
            'data' => '20200706',
            'atendimento' => 'O paciente apresentou um quadro de diabetes.',
            'paciente_id' => 2
                ]);

        DB::table('consultas')->insert([
            'data' => '20201205',
            'atendimento' => 'O paciente apresentou uma melhora significativa no quadro de diabetes.',
            'paciente_id' => 2
                ]);

        DB::table('consultas')->insert([
            'data' => '20190304',
            'atendimento' => 'Paciente encaminhado para raio-X.',
            'paciente_id' => 3
                ]);

        DB::table('consultas')->insert([
            'data' => '20190815',
            'atendimento' => 'Paciente apresentou a ressonância do joelho.',
            'paciente_id' => 3
                ]);

        DB::table('consultas')->insert([
            'data' => '20191009',
            'atendimento' => 'O paciente apresentou um quadro baixo de plaquetas.',
            'paciente_id' => 3
                ]);

        DB::table('consultas')->insert([
            'data' => '20210110',
            'atendimento' => 'O paciente apresentou um quadro grave de inflamação da garganta.',
            'paciente_id' => 4
                ]);

        DB::table('consultas')->insert([
            'data' => '20210202',
            'atendimento' => 'O paciente apresentou um quadro de febre, gripe e tosse.',
            'paciente_id' => 4
                ]);

        DB::table('consultas')->insert([
            'data' => '20200315',
            'atendimento' => 'O paciente recebeu uma bolsa de sangue do tipo A+.',
            'paciente_id' => 5
                ]);

        DB::table('consultas')->insert([
            'data' => '20200120',
            'atendimento' => 'O paciente foi encaminhado para cirurgia.',
            'paciente_id' => 5
                ]);
    }

}
