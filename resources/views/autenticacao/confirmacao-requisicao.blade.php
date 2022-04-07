@extends('layouts.app')

@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 shadow corpoRequisicao">
                <!--TITULO-->
                <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                    <div class="col-md-12 tituoRequisicao mt-3 p-0">
                        Protocolo
                    </div>
                </div>

                <!--CORPO-->
                <div class="row py-2">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('finaliza-requisicao') }}">
                            @csrf
                            {{-- nome aluno --}}
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label class="tituloProtocolo">Nome</label>
                                    <div class="py-2 px-2 textoProtocolo">{{$requisicao->perfil->aluno->user->name}}</div>
                                </div>
                            </div>
                            {{-- curso --}}
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label class="tituloProtocolo">Curso</label>
                                    <div class="py-2 px-2 textoProtocolo">{{$requisicao->perfil->curso->nome}}</div>
                                </div>
                            </div>
                            {{-- vinculo --}}
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label class="tituloProtocolo">Vinculo</label>
                                    <div class="py-2 px-2 textoProtocolo">{{$requisicao->perfil->situacao}}</div>
                                </div>
                            </div>

                            {{-- documentos solicitados --}}
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <span class="tituloProtocolo">Confirmamos o recebimento de sua solicitação para o(s) documento(s) abaixo:</span>
                                    <div class="py-2 px-2 textoProtocolo">
                                        <ul class="list-group list-unstyled">
                                            @foreach ($arrayAux as $docSolicitado)
                                                <li value="Documentos solicitados">
                                                    @if($docSolicitado->id==3){{$docSolicitado->tipo}}
                                                    Escolar @elseif($docSolicitado->id!=3) {{$docSolicitado->tipo}} @endif
                                                </li>

                                                @if($docSolicitado->documento_id==4)
                                                    <span class="textoFicha">Descrição do documento
                                                        solicitado {{$docSolicitado->detalhes}}</span>
                                                @endif
                                                @if($docSolicitado->documento_id==5)
                                                    <span class="textoFicha">Descrição do documento
                                                        solicitado {{$docSolicitado->detalhes}}</span>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- data requisição --}}
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label class="tituloProtocolo">Data da requisição</label>
                                    <div class="py-2 px-2 textoProtocolo">{{$date}}</div>
                                </div>
                            </div>

                            {{-- hora requisição --}}
                            <div class="row form-group">
                                <div class="col-sm-12">
                                    <label class="tituloProtocolo">Hora da requisição</label>
                                    <div class="py-2 px-2 textoProtocolo">{{$hour}}</div>
                                </div>
                            </div>

                            {{-- Atenção --}}
                            <div class="row justify-content-sm-center form-group">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger">
                                        <strong><h5 class="text-center" style="">Atenção</h5></strong>
                                        <strong><h5 class="text-center" style="">Prazo de Entrega do documento: <b>Até
                                                    03(três) dias úteis </b> </h5></strong>
                                        {{-- <strong><h4 align="center" style="">A entrega dos documento(s) solicitado(s) está condicionada a apresentação de <b>Documento Oficial com foto</b>!</h4></strong> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn"
                                            align="center" style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px">
                                        {{ __('Voltar') }}
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
