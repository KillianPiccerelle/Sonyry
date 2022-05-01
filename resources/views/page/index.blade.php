@extends('layouts.app')


@section('content')

    <style>
        #myInput {
            background-color: azure;
            font-weight: bold;
            color: black;

        }

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
            background-color: lightgray;
            height: 100%;
        }
        #card-footer {
            color: floralwhite;
        }



    </style>

    <div class="container text-center">
        <div class="text-center">
            <h1 style="color: white">Liste de mes pages :</h1>
        </div>
        <br>
        <div class="text-center">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
        </div>
        <br>
        <div class="row" id="pages">
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
                                    <img src="{{ env('API_BASE_URL') . '/../' . $page->link }}" id="img">
                                <br>
                                <br>
                                <div class="container-fluid text-center" id="buttons">
                                    <a href="{{ route('page.edit', $page->id) }}" id="btnEdit" class="btn btn-outline-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Éditer
                                    </a>
                                    -
                                    <a href="{{ route('page.show', $page->id) }}" id="btnView" class="btn btn-outline-dark">
                                        <i class="fas fa-eye"></i>
                                        Consulter
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer" id="card-footer" style="background: linear-gradient({{$deg}}deg, black, lightgrey);">
                                <small>Dernière modification : {{ $page->updated_at_ }}</small>
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
                var input, filter, cards, cardContainer, h5, title, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementById("pages");
                cards = cardContainer.getElementsByClassName("col-md-4");
                for (i = 0; i < cards.length; i++) {
                    title = cards[i].querySelector(".card .card-header h5");
                    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                        cards[i].style.display = "";
                    } else {
                        cards[i].style.display = "none";
                    }
                }
            });
        });
    </script>


@stop
