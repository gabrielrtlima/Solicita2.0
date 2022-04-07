<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Unidade;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function createCurso(Request $request){
        $unidade = Unidade::find($request->unidade_id);
        if($request->unidade_id == null){
            return redirect()->route('home')->with('error', 'Selecione uma unidade');
        }
        return view('telas_admin.cadastro-curso', compact('unidade'));
    }

    public function storeCurso(Request $request){
        $curso = new Curso();
        $curso->nome = $request->name;
        $curso->unidade_id = $request->campus;

        $transformandoAbreviacao = preg_replace("/ [ de][ em][ da][ e]/","",$request->name);
        preg_match_all('/\s?([A-Z])/', $transformandoAbreviacao, $matches);
        $abreviacao = implode('', $matches[1]);

        $curso->abreviatura = $abreviacao;
        $curso->save();
        return redirect()->route('listar-cursos', ['unidade_id' => $curso->unidade_id])->with('success', 'Curso cadastrado com sucesso!');
    }

    public function listarCursos(Request $request){
        $unidade = Unidade::find($request->unidade_id);
        $cursos = Curso::all();
        if($request->unidade_id == null){
            return redirect()->route('home')->with('error', 'Selecione uma unidade');
        }
        return view('telas_admin.listar-cursos', compact('cursos', 'unidade'));
    }

    public function editarCurso(Request $request){
        $curso = Curso::find($request->curso_id);
        $unidades = Unidade::all();
        return view('telas_admin.editar-curso', compact('curso', 'unidades'));
    }

    public function atualizarCurso(Request $request){
        $curso = Curso::find($request->curso_id);
        $curso->nome = $request->name;
        $curso->abreviatura = $request->abreviacao;
        $unidade_id = Unidade::find($curso->unidade_id);
        $curso->unidade_id = $request->campus;
        $curso->update();
        return redirect()->route('listar-cursos', compact('unidade_id'))->with('success', 'Curso atualizado com sucesso!');
    }

}
