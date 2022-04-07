<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function createCampus()
    {
        $instituicoes = Instituicao::all();
        return view('telas_admin.cadastro-campus', compact('instituicoes'));
    }

    public function storeCampus(Request $request){
        $unidade = new Unidade();
        $unidade->nome = $request->name;
        $unidade->instituicao_id = $request->instituicao;
        $unidade->save();
        return redirect()->route('home')->with('Unidade cadastrada com sucesso!');
    }

    public function gerenciarCampi() {
        $unidades = Unidade::all();
        return view('telas_admin.listar-campi', compact('unidades'));
    }
}
