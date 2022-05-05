<?php

namespace Database\Seeders;

use App\Models\Instituicao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $instituicoes = Instituicao::All();
        DB::table('unidades')->insert([
          'nome'=> 'Campus Garanhuns',
          'instituicao_id'=> $instituicoes[0]->id,
        ]);
        DB::table('unidades')->insert([
            'nome'=> 'Campus Santo Amaro',
            'instituicao_id'=> $instituicoes[0]->id,
        ]);
    }
}
