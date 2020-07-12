@extends('layouts.app')

@section('content')
    <div class="login-sonyry" style="text-align: center">
        <div class="col-md-3">
            <form class="card-body" method="POST" action="{{ route('login') }}">
                @csrf

                <img class="mb-4" src="https://media.discordapp.net/attachments/718040099618685009/718041074169413775/unknown.png" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">{{ __('Connexion') }}</h1>
                <label for="inputEmail" class="sr-only">{{ __('Adresse E-Mail') }}</label>
                <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Adresse Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label for="inputPassword" class="sr-only">{{ __('Mot de passe') }}</label>
                <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Se rappeler de moi
                    </label>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    {{ __('Me connecter') }}
                </button>
                <a class="ml-3 btn btn-link" href="{{ route('register') }}">
                    Pas encore inscrit ?
                </a>
            </form>
        </div>
    </div>


@endsection
