@extends('layouts.app')

@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 corpoRequisicao shadow">
                <div class="row mx-1 p-0" style="border-bottom: var(--textcolor) 2px solid">
                    <div class="col-md-12 tituoRequisicao mt-3 p-0">
                        Editar Perfil
                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <form action="{{  route('atualizar-bibliotecario')  }}" method="POST">
                        @csrf
                        <div class="form-group row justify-content-center mt-3">
                            <div class="col-sm-12">
                                <label for="name" class="row px-3 textoFicha">Nome Completo:
                                    <input id="name" type="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $user->name }}" required autocomplete="name" autofocus
                                           placeholder="Nome Completo">
                                </label>
                                @error('name')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mt-3">
                            <div class="col-sm-12">
                                <label for="email" class="row px-3 textoFicha">Email:
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ $user->email }}" required autocomplete="email"
                                           autofocus placeholder="E-Mail">
                                </label>
                                @error('email')
                                <span class="invalid-feedback" role="alert" style="overflow: visible; display:block">
                    <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Botões -->
                        <div class="form-group row mb-3">

                            <div class="col-md-6 " style="">
                                <a style="background-color: var(--padrao); border-radius: 0.5rem; color: white; font-size: 17px"
                                   class="btn" href="{{route('perfil-bibliotecario')}}">Voltar</a>
                            </div>

                            <div class="col-md-6 text-right">
                                <button
                                    style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px"
                                    type="submit" class="btn">
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
