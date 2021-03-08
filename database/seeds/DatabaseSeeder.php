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
        $this->call(PacienteSeeder::class);
        $this->call(AgendamentoSeeder::class);
        $this->call(ConsultaSeeder::class);
    }
}
