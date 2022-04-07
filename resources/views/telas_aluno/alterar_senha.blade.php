@extends('layouts.app')

@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 corpoRequisicao shadow">
                <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                    <div class="col-md-12 tituoRequisicao mt-3 p-0">
                        Alterar Senha
                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <form action="{{  route('alterar-senha')   }}" method="POST">
                        @csrf
                        <div class="form-group">

                            <!-- Form Senha Antiga -->
                            <div class="form-group row justify-content-center mt-3">

                                <div class="col-md-12">
                                    <label for="password" class="row px-3 textoFicha">Senha atual:
                                        <input id="password-old" type="password"
                                               class="form-control @error('password-old') is-invalid @enderror"
                                               name="atual" required autocomplete="current-password"
                                               placeholder="Senha Antiga">
                                    </label>
                                    @error('password-old')
                                    <span class="invalid-feedback" role="alert"
                                          style="overflow: visible; display:block;">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Form Senha -->
                            <div class="form-group row justify-content-center">

                                <div class="col-md-12">
                                    <label for="password" class="row px-3 textoFicha"> Nova Senha:
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password"
                                               placeholder="Nova Senha">
                                    </label>
                                    <span style="color:red">*Mínimo de 8 caracteres.</span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"
                                          style="overflow: visible; display:block;">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Form Confirmar Senha -->
                            <div class="form-group row justify-content-center">

                                <div class="col-md-12">
                                    <label for="password-confirm" class="row px-3 textoFicha">Confirmar Nova Senha:
                                        <input id="password-confirm" type="password"
                                               class="form-control @error('password-confirm') is-invalid @enderror"
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Confirmar Nova Senha">
                                    </label>
                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert"
                                          style="overflow: visible; display:block;">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Botões -->
                            <div class="form-group row mb-0">

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

@endsection
