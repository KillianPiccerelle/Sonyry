@extends('layouts.app')

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
                <label for="categorie_id" style="color: white">Choisir la catégorie : </label>
                <select name="categorie_id">
                    <option value="">Choisir une catégorie</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endforeach
            </div>
            <div class="form-group">
                <label style="color: white" for="content">Votre sujet</label>
                <textarea name="content" id="content" class="form-control @error('content')
                    is-invalid @enderror" rows="5"></textarea>
                @error('content')
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Créer mon topic</button>
        </form>
    </div>

@endsection
