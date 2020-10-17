@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 style="color: white">{{ $topic->title }}</h1>
        <hr>
        <form action="{{ route('topics.update', $topic->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label style="color: white" for="title">Titre du topic</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       name="title" id="title" value="{{ $topic->title }}">
                @error('title')
                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label style="color: white" for="content">Votre sujet</label>
                <textarea name="content" id="content" class="form-control @error('content')
                    is-invalid @enderror" rows="5">{{ $topic->content }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Modifier mon topic</button>
        </form>
    </div>

@endsection
