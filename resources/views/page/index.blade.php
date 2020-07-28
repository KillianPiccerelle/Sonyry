@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="card-header text-center">
            <h1>Liste de mes pages :</h1>
        </div>
        <br>
        <div class="row">
            @if(count($pages) > 0)
                @foreach($pages as $page)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $page->title }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}">
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Éditer
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Dernière modification : {{ $page->updated_at->format('d/m/y à H\hi') }}</small>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                <p>Pas de pages.</p>
            @endif
        </div>
    </div>

@stop
