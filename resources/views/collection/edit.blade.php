@extends('layouts.app')


@section('content')

    <link rel="stylesheet" href="/css/collections/index.css">
    <div class="container text-center">
        <div class="text-center">
            <h5 style="color: white;">Titre de la collection : <b>{{ $collection->name }}</b></h5>
        </div>
        <div>
            <p style="color: white">Description :</p>
            <p style="color: white">{{ $collection->description }}</p>
        </div>
        <br>
        <div class="text-center">
            <a class="btn btn-outline-info" href="{{ route('collection.addPages', $collection->id) }}">
                Ajouter
            </a>
            -
            <button class="btn btn-outline-info" data-toggle="modal" data-target="#modalUpdate">
                Modifier
            </button>
            <div class="float-right">
                <button class="btn btn-outline-danger" style="width: 200px" data-toggle="modal"
                        data-target="#modalDelete">
                    Supprimer
                </button>
            </div>
            <a style="width: 200px" class="btn btn-outline-primary float-left" href="{{ route('collection.index') }}">Revenir
                aux collections</a>
        </div>
        <hr>
        <div class="form-row">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
        </div>
        <br>
        <div class="row" id="pages">
            @if(count($collection->pages) > 0)
                @foreach($collection->pages as $page)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $page->page->title }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <img src="{{ env('API_BASE_URL') . '/../' . $page->page->link }}" height="150px">
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('page.edit', $page->page->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Éditer
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Dernière modification : {{ $page->page->updated_at_ }}</small>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                <p style="color: white">Pas de pages.</p>
            @endif
        </div>
    </div>

    <!-- update modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-2" role="dialog" id="modalUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('collection.update', $collection->id) }}"
                      class="comment-form contact-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier les informations de la collection</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="name">Nom de la collection</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $collection->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description de la collection</label>
                                <textarea type="textarea" class="form-control" id="description"
                                          name="description">{{$collection->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                            <div class="form-group">
                                <label for="image"><i>Image actuelle :</i></label>
                                <br>

                                <img src="{{ env('API_BASE_URL') . '/../' . $collection->link }}"
                                     height="300px">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="modifier">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete collection modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer la collection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la collection ?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('collection.destroy.fix', $collection->id) }}" type="button"
                       class="btn btn-danger">
                        Supprimer
                    </a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var input, filter, cards, cardContainer, h5, title, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementById("pages");
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
