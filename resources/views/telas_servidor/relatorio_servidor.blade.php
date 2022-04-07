@extends('layouts.app')

@section('conteudo')

    <div class="container">
        <div class="row" style="border-bottom: var(--textcolor) 2px solid">
            <span class="titulo">Relatório</span>
        </div>
    </div>

    <div class="container mt-3 align-middle" style="background-color: #C2C2C2; border-radius: 1rem">
        <form action="{{  route('listar-relatorio-post')  }}" method="POST">
            @csrf
            <div class="row pt-3 justify-content-between">
                <div  style="align-items: center" class="form-group p-0 ml-3">
                    <button type="submit" class="btn" style="background-color: #C2C2C2">
                        <img style="color: white" src="{{asset('images/botao_pesquisa.svg')}}" width="25px">
                    </button>
                </div>
                <div class="input-group date form-group col-md-5">
                    <label for="example-date-input1" class="col-form-label mr-2">Início:</label>
                    <input style="border-radius: 0.5rem" class="form-control  @error('dataInicio') is-invalid @enderror " type="date"
                           name="dataInicio" value="2020-04-23" id="example-date-input1">
                    @error('dataInicio')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group date form-group col-md-5">
                    <label for="example-date-input2" class="col-form-label mr-2">Fim:</label>
                    <input style="border-radius: 0.5rem" class="form-control  @error('dataFim') is-invalid @enderror" type="date" name="dataFim" value="2020-04-23" id="example-date-input2">
                    @error('dataFim')
                    <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            <div class="caixaSelecao shadow text-center p-5 my-3" style="background-color: #3C498F">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa">Declaração de Vínculo</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorDeclaracaoVinculo))
                        {{$contadorDeclaracaoVinculo}}
                    @endif
                </span>
            </div>
            <div class="caixaSelecao shadow text-center p-5 my-3" style="background-color: #102AB8">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa">Comprovante de Matrícula</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorComprovanteMatricula))
                        {{$contadorComprovanteMatricula}}
                    @endif
                </span>
            </div>
            <div class="caixaSelecao shadow text-center p-5 my-3" style="background-color: #4D64DF">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa pt-3">Histórico</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorHistorico))
                        {{$contadorHistorico}}
                    @endif
                </span>
            </div>
            <div class="caixaSelecao shadow text-center p-2 my-3" style="background-color: #102490">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa pt-4">Programa de Disciplina</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorProgramaDisciplina))
                        {{$contadorProgramaDisciplina}}
                    @endif
                </span>
            </div>
        </div>
        <div class="row">
            <div class="caixaSelecao shadow text-center p-5 my-3" style="background-color: #121E5C">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa">Outros</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorOutros))
                        {{$contadorOutros}}
                    @endif
                </span>
            </div>
            <div class="caixaSelecao shadow text-center p-5 my-3 ml-5" style="background-color: #121E5C">
                <div class="card-body d-flex justify-content-center">
                    <span class="textoCaixa">Total</span>
                </div>
                <span class="textoCaixa2">
                    @if(isset($contadorDeclaracaoVinculo) || isset($contadorComprovanteMatricula) || isset($contadorHistorico)
|| isset($contadorProgramaDisciplina) || isset($contadorOutros))
                        {{$total}}
                    @endif
                </span>
            </div>
        </div>
    </div>
@endsection
