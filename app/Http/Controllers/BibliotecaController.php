<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BibliotecaController extends Controller
{
    // Redireciona para tela de login ao entrar no sistema
    public function index()
    {
        //return view('biblioteca.listar');
    }

    public function createBiblioteca(Request $request)
    {
        $unidade = Unidade::find($request->unidade_id);
        return view('telas_biblioteca.cadastro-biblioteca', compact('unidade'));
    }


    public function storeBiblioteca(Request $request)
    {
        $biblioteca = new Biblioteca();
        $biblioteca->nome = $request->name;
        $biblioteca->email = $request->email;
        $biblioteca->unidade_id = $request->campus;
        $biblioteca->save();
        return redirect()->route('home')->with('success', 'Biblioteca cadastrada com sucesso!');
    }

    public function editarBiblioteca(Request $request)
    {
        $unidades = Unidade::all();
        $biblioteca = Biblioteca::find($request->biblioteca_id);
        return view('telas_biblioteca.editar-biblioteca', compact('biblioteca', 'unidades'));
    }

    public function atualizarBiblioteca(Request $request)
    {
        $biblioteca = Biblioteca::find($request->biblioteca_id);
        $biblioteca->nome = $request->name;
        $biblioteca->email = $request->email;

        $unidadeAntiga = $biblioteca->unidade_id;

        $biblioteca->unidade_id = $request->campus;
        $biblioteca->update();
        return redirect()->route('listar-bibliotecas', ['unidade_id' => $unidadeAntiga])->with('success', 'Biblioteca atualizada com sucesso!');
    }

    public function listarBiblioteca(Request $request)
    {
        $unidade = Unidade::find($request->unidade_id);
        $bibliotecas = Biblioteca::all(); //Bibliotecario autenticado
        return view('telas_biblioteca.listar-bibliotecas', compact('bibliotecas', 'unidade'));
    }

}
