<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $aluno_id = DB::table('alunos')->where('cpf','12345678900')->pluck('id');
      $unidade_id = DB::table('unidades')->where('nome','Campus Santo Amaro')->pluck('id');
      $curso_id = DB::table('cursos')->where('nome','Bacharelado em Medicina')->pluck('id');
      DB::table('perfils')->insert([
        'default'=>'Bacharelado em Medicina',
        'situacao'=>'Matriculado',
        'aluno_id'=>$aluno_id[0],
        'unidade_id'=>$unidade_id[0],
        'curso_id'=>$curso_id[0],
        'valor'=>true
      ]);

        $aluno_id = DB::table('alunos')->where('cpf','12345678922')->pluck('id');
        $unidade_id = DB::table('unidades')->where('nome','Campus Garanhuns')->pluck('id');
        $curso_id = DB::table('cursos')->where('nome','Bacharelado em Engenharia de Software')->pluck('id');
        DB::table('perfils')->insert([
            'default'=>'Bacharelado em Engenharia de Software',
            'situacao'=>'Matriculado',
            'aluno_id'=>$aluno_id[0],
            'unidade_id'=>$unidade_id[0],
            'curso_id'=>$curso_id[0],
            'valor'=>true
        ]);



//      $aluno_id = DB::table('alunos')->where('cpf','98765432100')->pluck('id');
//      $unidade_id = DB::table('unidades')->where('nome','UFAPE - SEDE (Unidade Acadêmica de Garanhuns)')->pluck('id');
//      $curso_id = DB::table('cursos')->where('nome','Agronomia')->pluck('id');
//      DB::table('perfils')->insert([
//        'default'=>'Agronomia',
//        'situacao'=>'Matriculado',
//        'aluno_id'=>$aluno_id[0],
//        'unidade_id'=>$unidade_id[0],
//        'curso_id'=>$curso_id[0],
//
//      ]);
    }
}
