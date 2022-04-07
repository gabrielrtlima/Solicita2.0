@extends('layouts.app')
@section('conteudo')

@section('titulo','Home Administrador')
@section('navbar2.blade.php')
    Home
@endsection
<div class="container">
    <div class="row" style="border-bottom: var(--textcolor) 2px solid">
        <span class="titulo">Cadastros</span>
    </div>
</div>

<div class="container text-center">

    <div class="row justify-content-between mt-5">

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: var(--escolaridade);">
            <a href="{{ route("cadastro-servidor")}}">
                <div class="text-center pt-4 pb-3">
                    <img class="" src="images/escolaridade-adm.svg" height="100px">
                </div>
                <div class="text-center">
                    <div class="textoCaixa">Servidor</div>
                </div>
            </a>
        </div>

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: var(--biblioteca)">
            <a href="{{ route("cadastro-bibliotecario")}}">
                <div class="col-md-12 pt-4">
                    <div class="text-center">
                        <img class="pb-3" src="images/biblioteca-aluno.svg" height="120px">
                    </div>
                    <div class="text-center align-middle">
                        <div class="textoCaixa">Bibliotecário</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: white">
            <a href="{{ route("listar-usuario")}}">
                <div class="text-center pb-3">
                    <i style="color: var(--textcolor)" class="fa-regular fa-address-book fa-7x"></i>
                </div>
                <div class="text-center">
                    <div style="color: var(--textcolor)" class="textoCaixa">Listagem de Usuários</div>
                </div>
            </a>
        </div>

        <div class="text-center p-5 shadow caixaSelecao" style="background-color: white">
            <a href="{{ route("gerenciar-campi")}}">
                <div class="text-center pb-3">
                    <i style="color: var(--textcolor)" class="fa-solid fa-building-columns fa-7x"></i>
                </div>
                <div class="text-center">
                    <div style="color: var(--textcolor)" class="textoCaixa">Gerenciar Campi</div>
                </div>
            </a>
        </div>

    </div>
</div>

@endsection
