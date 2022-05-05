<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BibliotecaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bibliotecas')->insert([
            'nome'=> 'Biblioteca Campus Garanhuns',
            'email'=> 'biblioteca.garanhuns@upe.br',
            'unidade_id' => 1,
        ]);

        DB::table('bibliotecas')->insert([
            'nome'=> 'Biblioteca Campus Santo Amaro',
            'email'=> 'biblioteca.santoamaro@ufape.br',
            'unidade_id' => 2,
        ]);
    }
}
