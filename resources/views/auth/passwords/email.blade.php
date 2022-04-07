@extends('layouts.app')

@section('conteudo')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 corpoRequisicao shadow">
                <div class="col-md-12">
                    <div class="tituoRequisicao mt-3 p-0">
                        Redefinir a senha
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label textoFicha">{{ __('Seu e-mail:') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-4 text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn" style="background-color: var(--confirmar); border-radius: 0.5rem; color: white; font-size: 17px">
                                    {{ __('Enviar link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
