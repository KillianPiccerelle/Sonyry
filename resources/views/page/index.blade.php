@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="text-center">
            <h1>Liste de mes pages :</h1>
        </div>
        <br>
        <div class="text-center">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
        </div>
        <br>
        <div class="row">
            @if(count($pages) > 0)
                @php
                    $count = 1;
                    $deg = 0;
                @endphp
                @foreach($pages as $page)
                    @if($count%2) @php $deg=70 @endphp @else @php $deg=280 @endphp @endif
                    <div class="col-md-4" >
                        <div class="card text-center" id="card">
                            <div id="card-header" class="card-header" style="background: linear-gradient({{$deg}}deg, black, lightgrey);">
                                <h5 id="title"><span>{{ $page->title }}</span></h5>
                            </div>
                            <div class="card-body container-fluid" id="card-body">
                                @if($page->image === 'default_page.png')
                                    <img src="/storage/default/{{ $page->image }}" id="img">
                                @else
                                    <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}" id="img">
                                @endif
                                <br>
                                <br>
                                <div class="container-fluid text-center" id="buttons">
                                    <a href="{{ route('page.edit', $page->id) }}" id="btnEdit" class="btn btn-outline-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Éditer
                                    </a>
                                    -
                                    <a href="#" id="btnView" class="btn btn-outline-dark">
                                        <i class="fas fa-eye"></i>
                                        Consulter
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer" id="card-footer" style="background: linear-gradient({{$deg}}deg, black, lightgrey);">
                                <small>Dernière modification : {{ $page->updated_at->format('d/m/y à H\hi') }}</small>
                            </div>
                        </div>
                        <br>
                    </div>
                    @php
                        $count++;
                    @endphp
                @endforeach
            @else

            @endif
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <style>
        #card {
            border: solid black  1px;
            height: 410px;
        }
        #card-header {
            border: #303a40;
        }
        #img {
            border-radius: 5px;
            width: 100%;
            height: 205px;
            border: solid black 1px;
            max-height: 80%;

        }
        #title {
            color: floralwhite;
        }
        #card-body {
            height: 100%;
        }
        #card-footer {
            color: floralwhite;
        }


    </style>

@stop
