@extends('layouts.app')


@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 corpoRequisicao shadow pb-3">
                <div class="row mx-1" style="border-bottom: var(--textcolor) 2px solid">
                    <div class="col-md-12 tituoRequisicao mt-3 p-0">
                        Cadastro de Curso
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form action="{{  route('criar-curso')  }}" method="POST">
                            @csrf
                            <div class="row justify-content-center py-2 mt-2">
                                <div class="form-group col-md-12">
                                    <label class="textoFicha" for="name">Nome do Curso</label>
                                    <input id="nomeServidor" type="name"
                                           class="form-control @error('name') is-invalid @enderror backgroundGray"
                                           name="name" value="{{ old('name') }}" required autocomplete="name"
                                           autofocus placeholder="Digite o nome do curso. Ex.: Bacharelado em Engenharia de Software">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-center py-2">
                                <div class="form-group col-md-12">
                                    <label class="textoFicha" for="campi">Campus</label>
                                    <select name="campus" id="campi"
                                            class="form-control @error('campus') is-invalid @enderror backgroundGray" required>
                                        <option value="{{ $unidade->id }}" disable selected hidden>{{ $unidade->nome }}</option>
                                        @error('campus')
                                        <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </select>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="row justify-content-between my-2">
                                <div class="col-md-6">
                                    <a style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px" class="btn" href="{{ route('listar-cursos', ['unidade_id' => $unidade->id]) }}">{{ __('Voltar') }}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px" type="submit" class="btn"
                                            onclick="confirmacaoCadastro();">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
