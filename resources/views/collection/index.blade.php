@extends('layouts.app')


@section('content')

    <div class="container">
        <div class=" text-center">
            <h1>Liste de mes collections :</h1>
        </div>
        <div class="text-center">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une collection..">
        </div>
        <br>
        <div class="row" id="collections">
            @if(count($collections) > 0)
                @foreach($collections as $collection)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $collection->name }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    @if($collection->image === 'default_collection.jpg')
                                    <img src="/storage/default/{{ $collection->image }}" height="150px">
                                    @else
                                        <img src="/storage/collections/{{ Auth::user()->id  }}/{{ $collection->image }}" height="150px">
                                    @endif
                                </div>
                                <br>
                                <div class="container text-center">
                                    <a href="{{ route('collection.edit', $collection->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Editer
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <p>Nombre de pages dans la collection : <span>{{ count($collection->pages) }}</span></p>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                <div class="container text-center">
                    <h5><i>Vous ne possédez pas de collections, veuillez en créer une : </i></h5><a href="{{ route('collection.create') }}" class="btn btn-outline-dark"> Ici </a>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var input, filter, cards, cardContainer, h5, title, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementById("collections");
                cards = cardContainer.getElementsByClassName("col-md-4");
                for (i = 0; i < cards.length; i++) {
                    title = cards[i].querySelector(".card .card-header h5 span");
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
