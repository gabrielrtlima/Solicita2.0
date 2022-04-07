@extends('layouts.app')

@section('conteudo')
    <!-- @section('navbar2.blade.php')
    Home
@endsection -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 corpoRequisicao shadow">

            <!-- TITULO -->

            <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                <div class="col-md-12 tituoRequisicao mt-3 p-0">
                    Biblioteca
                </div>
            </div>

            <!-- OPÇOES -->

            <div class="row py-2">
                <div class="col-md-12">
                    <form method="POST" enctype="multipart/form-data" id="formRequisicao"
                          action="{{ route('cadastrarDocumento') }}">
                        @csrf
                        <div class="py-3">
                            <label class="textoFicha">Aluno(a):</label>
                            <input class="form-control" type="text" name="nome" size="100%" disabled value="{{Auth::user()->name}}">
                        </div>
                        <div class="py-3">
                            <label class="textoFicha">Perfil:</label>
                            <select name="default" class="form-control" style="background-color: var(--background)">
                                @foreach($perfis as $perfil)
                                    <option @if($perfil->valor==true) selected
                                            @endif value="{{$perfil->id}}">{{$perfil->default}}
                                        - {{$perfil->situacao}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="py-3 ">
                            <label class="textoFicha">Tipo de Documento:</label>
                            @foreach($tipos_documentos as $tipo)
                                <div>
                                    <input type="radio" name="documento" value="{{$tipo->id}}"
                                           id="{{$tipo->tipo}}" @if($tipo->tipo == 'Dissertacao') checked @endif>
                                    @if($tipo->tipo == 'Monografia')Monografia
                                    @elseif($tipo->tipo == 'Tese')Tese
                                    @elseif($tipo->tipo == 'TCC')Trabalho de Conclusão de Curso
                                    @elseif($tipo->tipo == 'ProgramaEduc')Produto Educacional
                                    @elseif($tipo->tipo == 'Dissertacao')Dissertação
                                    @else {{$tipo->tipo}}
                                    @endif</input>
                                </div>
                            @endforeach
                        </div>

                        <!-- BOTOES -->
                        <div class="row justify-content-between my-3">
                            <div class="col-md-6">
                                <a class="btn" href="{{ route('cancela-requisicao')}}" style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px">
                                    {{ ('Cancelar') }}
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn" style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px">
                                    {{ ('Solicitar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
