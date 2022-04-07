@extends('layouts.app')


@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 corpoRequisicao shadow">

                <!--TITULO-->

                <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                    <div class="col-md-12 tituoRequisicao mt-3 p-0">
                        Cadastro
                    </div>
                </div>

                <!--CORPO-->

                <form action="{{  route('register')  }}" method="POST" class="py-4" name="cadastroForm" id="cadastroForm">
                    @csrf
                    {{-- Nome --}}
                    <div class="row justify-content-center form-group mb-0">
                        <div class="form-group col-md-8">
                            <label for="name" class="row px-3 textoFicha"> Nome Completo:
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror "
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">
                            </label>
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="name" class="row px-3 textoFicha"> CPF:
                                <input id="cpf" type="name" class="form-control @error('name') is-invalid @enderror"
                                       name="cpf" value="{{ old('cpf') }}" required autocomplete="name" autofocus placeholder="CPF">
                            </label>
                            @error('cpf')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <!-- Vínculo -->
                    <div class="row justify-content-center my-0">
                        <div class="form-group col-sm-4">
                            <label for="vinculo" class="row px-3 textoFicha">Tipo de vínculo:</label>
                            <select name="vinculo" id="vinculo" class="browser-default custom-select">
                                <option value="" disable selected hidden>-- Selecionar Vínculo --</option>
                                <option value="1" >Matriculado</option>
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

                        <div class="form-group col-sm-4">
                            <label for="unidade" class="row px-3 textoFicha">Unidade:</label>
                            <select name="unidade" id="unidade" class="browser-default custom-select">
                                <option value="" disable hidden>-- Selecionar Unidade --</option>
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

                        <div class="col-md-4">
                            <!-- Cursos-->
                            <label for="cursos" class="row px-3 textoFicha">Curso:</label>
                            <select name="cursos" id="cursos" class="browser-default custom-select">

                                <option value="" disable selected hidden>-- Selecionar Curso --</option>
                                @foreach($cursos as $curso)
                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                @endforeach

                                @error('cursos')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                        </div>

                    </div>

                    <!-- Form E-mail -->
                    <div class="form-group row justify-content-center">

                        <div class="form-group col-md-4">
                            <label for="email" class="row px-3 textoFicha">E-mail:
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail">
                            </label>
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p id='result'></p>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="password" class="row px-3 textoFicha"> Senha:
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password" placeholder="Senha">
                            </label>
                            <span style="color:red">*Mínimo de 8 caracteres.</span>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="password-confirm" class="row px-3 textoFicha" >Confirmar senha:
                                <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror"
                                       name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
                            </label>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="overflow: visible; display:block;">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="form-group row justify-content-between">
                        <div class="col-sm-6">
                            <a style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px" class="btn" href="{{  route('home')}}" >Voltar</a>
                        </div>

                        <div class="col-sm-6 text-right">
                            <button style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px" id='validate' type="submit" class="btn">
                                {{ __('Cadastrar') }}
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
<script type="text/javascript" >
  $(document).ready(function($){
    $('#cpf').mask('000.000.000-00');

  });

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

  function validateEmail(email)
  {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
  }


  function validate() {
    var $result = $("#result");
    var email = $("#email").val();
    $result.text("");

    if (validateEmail(email)) {
      $result.text("Esse e-mail é valido");
      $result.css("color", "green");
      return true;
    } else {
      $result.text("Esse e-mail não é valido ");
      $result.css("color", "red");
      return false;
    }

  }

  $("#validate").on("click", validate);





</script>

@endsection
