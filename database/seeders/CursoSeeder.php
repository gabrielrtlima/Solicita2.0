<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cursos = ['Bacharelado em Engenharia de Software', 'Bacharelado em Psicologia', 'Bacharelado em Medicina'];
        $abreviatura = ['BES', 'BP', 'BM'];
        $unidade_id = DB::table('unidades')->where('nome','Campus Garanhuns')->pluck('id');
        for ($i=0; $i < sizeof($cursos); $i++) {
            DB::table('cursos')->updateOrInsert([
                'nome' => $cursos[$i],
                'abreviatura' => $abreviatura[$i],
                'unidade_id' => $unidade_id[0],
            ]);
        }

        $cursos = ['Bacharelado em Medicina'];
        $abreviatura = ['BM'];
        $unidade_id = DB::table('unidades')->where('nome','Campus Santo Amaro')->pluck('id');
        for ($i=0; $i < sizeof($cursos); $i++) {
            DB::table('cursos')->updateOrInsert([
                'nome' => $cursos[$i],
                'abreviatura' => $abreviatura[$i],
                'unidade_id' => $unidade_id[0],
            ]);
        }
    }
}
