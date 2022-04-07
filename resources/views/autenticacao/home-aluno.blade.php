@extends('layouts.app')
@section('conteudo')

@section('titulo','Home Aluno')

@section('navbar2.blade.php')
    Home
@endsection

<div class="container">
    <div class="row" style="border-bottom: var(--textcolor) 2px solid">
        <span class="titulo">Solicitações</span>
    </div>
</div>

<div class="container text-center">

    <div class="row justify-content-between mt-5">

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: var(--escolaridade);">
            <a href="{{ route("prepara-requisicao")}}">
                <div class="text-center pt-4">
                    <img class="pb-3" src="images/escolaridade-aluno.svg" height="120px">
                </div>
                <div class="text-center">
                    <div class="textoCaixa">Escolaridade</div>
                </div>
            </a>
        </div>

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: var(--biblioteca)">
            <a href="{{ route("prepara-requisicao-bibli")}}">
                <div class="col-md-12 pt-4">
                    <div class="text-center">
                        <img class="pb-3" src="images/biblioteca-aluno.svg" height="120px">
                    </div>
                    <div class="text-center align-middle">
                        <div class="textoCaixa">Biblioteca</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: white">
            <a href="{{ route("listar-requisicoes-aluno", ["titulo" => "Listar Documentos Solicitados"]) }}">
                <div class="text-center">
                    <img class="" src="images/vertical_split.svg" height="120px">
                </div>
                <div class="text-center">
                    <div style="color: var(--textcolor)" class="textoCaixa">Listagem de Documentos</div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
