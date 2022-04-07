@extends('layouts.app')

@section('conteudo')
    <div class="container-fluid background-blue">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 corpoRequisicao shadow">
                    <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                        <div class="col-md-12 tituoRequisicao mt-3 p-0">
                            Adicionar Perfil
                        </div>
                    </div>
                    <div class="col-md-12 p-0">
                        <form action="{{  route('salva-novo-perfil-aluno')  }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-group row justify-content-center mt-3">
                                    <div class="col-sm-12">
                                        <label for="vinculo" class="row px-3 textoFicha">Tipo de vínculo</label>
                                        <select name="vinculo" id="vinculo" class="browser-default custom-select">
                                            <option value="" disable selected hidden>-- Selecionar Vínculo --</option>
                                            <option value="1">Matriculado</option>
                                            <option value="2">Egresso</option>
                                            <option value="3">Especial</option>
                                            <option value="4">REMT - Regime Especial de Movimentação Temporária</option>
                                            <option value="5">Desistente</option>
                                            <option value="6">Matrícula Trancada</option>
                                            <option value="7">Intercâmbio</option>
                                            @error('vinculo')
                                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                      </span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <!-- Unidade Acadêmica-->
                                        <label for="unidade" class="row px-3 textoFicha">Unidade Acadêmica</label>
                                        <select name="unidade" id="unidade" class="browser-default custom-select">
                                            <option value="" disable selected hidden>-- Selecionar Unidade --</option>
                                            @foreach($unidades as $unidade)
                                                <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                                            @endforeach
                                            @error('unidade')
                                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                                            @enderror
                                        </select>

                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-sm-12">
                                        <!-- Cursos-->
                                        <label for="cursos" class="row px-3 textoFicha">Curso</label>
                                        <select name="curso" id="cursos" class="browser-default custom-select">
                                            <option value="" disable selected hidden>-- Selecionar Curso --</option>
                                            @foreach($cursos as $curso)
                                                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                            @endforeach
                                            @error('curso')
                                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                      <strong>{{ $message }}</strong>
                      </span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="row justify-content-center text-center">
                                    <div class="col-sm-12 mt-3" >
                                        <input type="checkbox" name="selecaoPadrao" value="true"> <span class="textoFicha">Definir perfil como padrão </span></input>
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="form-group row mb-0 mt-2">
                                    <div class="col-md-6 " style="">
                                        <a style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px" class="btn" href="{{route('perfil-aluno')}}">Voltar</a>
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <button  style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px" type="submit" class="btn">
                                            {{ __('Salvar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#unidade").change(function() {
            unidadeId = $(this).val();
            $.ajax({
                url: '/load-cursos/' + unidadeId,
                success: function(data) {
                    $("#cursos").html(data);
                },
            });
        });
    })
</script>

@endsection
