@extends('layouts.app')

@section('conteudo')
<!-- Informações do bibliotecario -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 corpoFicha shadow">
            <div class="row cabecalho">
                <div class="col-md-12 py-2 tituloCabecalho">
                    <div class="row justify-content-between  align-middle">
                        <div class="col-md-6">
                            Suas informações
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('editar-senha-bibliotecario')}}" class="btn p-0">
                                <img src="images/alterar_senha.svg" height="35px"
                                     title="Alterar Senha"></a>
                            <a href="{{route('editar-bibliotecario')}}" class="btn p-0">
                                <img src="images/botao_editar.svg" height="35px"
                                     title="Editar Perfil"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label for="nome" class="textoFicha mb-1">Nome:</label>
                    <div class="mt-0 pt-0" style="color: var(--textcolor); font-weight: 500; font-size: 18px">{{Auth::user()->name}}</div>
                </div>
            </div>
            <div class="row justify-content-between mt-2">
                <div class="col-md-6">
                    <label for="nome" class="textoFicha mb-1">Matrícula:</label>
                    <div class="mt-0 pt-0" style="color: var(--textcolor); font-weight: 500; font-size: 18px">{{$bibliotecario->matricula}}</div>
                </div>
                <div class="col-md-6">
                    <label for="biblioteca" class="textoFicha mb-1">Biblioteca:</label>
                    <div class="mt-0 pt-0" style="color: var(--textcolor); font-weight: 500; font-size: 18px">{{$biblioteca->nome}}</div>
                </div>
            </div>
            <div class="row mt-2 mb-3">
                <div class="col-md-12">
                    <label for="nome" class="textoFicha mb-1">E-mail</label>
                    <div class="mt-0 pt-0" style="color: var(--textcolor); font-weight: 500; font-size: 18px">{{$user->email}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
