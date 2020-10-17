@extends('layouts.app')

@section('extra-js')
    {!! NoCaptcha::renderJs() !!}
@endsection

@section('content')

    <div class="container">
        <h1 style="color: white">Créer un topic</h1>
        <hr>
        <form action="{{ route('topics.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label style="color: white" for="title">Titre du topic</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       name="title" id="title">
                @error('title')
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label style="color: white" for="content">Votre sujet</label>
                <textarea name="content" id="content" class="form-control @error('content')
                    is-invalid @enderror" rows="5"></textarea>
                @error('content')
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <div id="capatcha" >
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <strong><p style="color: white">Prouvez que vous n'êtes pas un Robot !</p></strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Créer mon topic</button>
        </form>
    </div>

@endsection
