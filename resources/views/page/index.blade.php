@extends('layouts.app')


@section('content')

    <div class="container">

        <div class="row">
            @foreach($pages as $page)
                <div class="col-md-4">
                    <div class="bi-text text-center">
                        <h5>{{ $page->title }}</h5>
                        <small>Dernière modification : {{ $page->updated_at }}</small>
                    </div>
                    <br>
                    <div class="text-center">
                        <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}">
                    </div>

                    <br>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                             Editer
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@stop
