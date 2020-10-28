@extends('layouts.app')


@section('content')

    <div class="container">
        <h1 style="color: white">Créer une Catégorie</h1>
        <hr>
        <form action="{{ route('categorie.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label style="color: white" for="libelle">Nom de la nouvelle catégorie</label>
                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                       name="libelle" id="title">
                @error('title')
                <div class="invalid-feedback">{{ $errors->first('libelle') }}</div>
                @enderror

            </div>
            <button class="btn btn-primary" type="submit">Créer ma catégorie</button>
        </form>
    </div>

@endsection
