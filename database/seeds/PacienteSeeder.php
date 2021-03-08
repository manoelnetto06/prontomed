<?php

use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pacientes')->insert([
            'nome' => 'Manoel Alves de Souza Neto',
            'telefone' => '73988269862',
            'dataNascimento' => '19851206',
            'sexo' => 'Masculino',
            'altura' => '1.85',
            'peso' => '85',
                 ]);

        DB::table('pacientes')->insert([
            'nome' => 'João Paulo de Souza',
            'telefone' => '73988568923',
            'dataNascimento' => '19880504',
            'sexo' => 'Masculino',
            'altura' => '1.82',
            'peso' => '80',
                 ]);

        DB::table('pacientes')->insert([
            'nome' => 'Ana de Jesus Faustino',
            'telefone' => '73988568965',
            'dataNascimento' => '19860321',
            'sexo' => 'Feminino',
            'altura' => '1.52',
            'peso' => '65.5',
                ]);

        DB::table('pacientes')->insert([
            'nome' => 'Maria Genoveva de Souza',
            'telefone' => '73988569865',
            'dataNascimento' => '19650110',
            'sexo' => 'Feminino',
            'altura' => '1.65',
            'peso' => '60.5',
                ]);

        DB::table('pacientes')->insert([
            'nome' => 'Gabriel Aparecido dos Santos',
            'telefone' => '73988215487',
            'dataNascimento' => '19940522',
            'sexo' => 'Masculino',
            'altura' => '1.75',
            'peso' => '90.5',
                ]);
    }
}
