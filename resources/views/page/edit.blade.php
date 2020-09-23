@extends('layouts.app')


@section('content')

    <br>
    <div class="container text-center">
        <div class="text-center">
            <h5>Titre de la page : <b id="title">{{ $page->title }}</b></h5>
        </div>
        <div>
            <p>Description :</p>
            <p id="description">{{ $page->description }}</p>
        </div>
        <br>
        <hr>
        <div class="container text-center">
            <button class="btn btn-dark text-left" id="btnEdit" data-toggle="modal" data-target="#modalUpdate">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                Editer la page
            </button>
            <button class="btn btn-secondary text-center" id="btnNewBloc" data-toggle="modal"
                    data-target="#modalNewBloc">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Nouveau bloc
            </button>
            <button class="btn btn-danger text-right" id="btnDelete" data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Supprimer la page
            </button>
        </div>
    </div>
    <div id="bloc" class="container">
        @include('page.bloc.index')
    </div>

    <!-- bloc create modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-2" role="dialog" id="modalNewBloc">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Configurer le bloc</h5>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <h4>Type du bloc</h4>
                            <button class="btn" id="btnBlocText" style="background-color: lightgray">Texte</button>
                            <button class="btn" id="btnBlocImage" style="background-color: lightgray">Image</button>
                            <button class="btn" id="btnBlocVideo" style="background-color: lightgray">Video</button>
                            <button class="btn" id="btnBlocScript" style="background-color: lightgray">Script</button>
                        </div>
                        <hr>
                        <!-- ZONE DE RECUP DU CONTENU DU BLOC-->
                        <div id="blocContent">

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSaveBloc">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Suppression modal -->
<<<<<<< HEAD
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalDelete">
=======
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="deleteModal">
>>>>>>> bloc
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer la page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la page ?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('page.destroy.fix', $page->id) }}" type="button" class="btn btn-danger">
                        Supprimer
                    </a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- update modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-2" role="dialog" id="modalUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('page.update', $page->id) }}" class="comment-form contact-form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier les informations de la page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="title">Titre de la page</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="{{ $page->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description de la page</label>
                                <textarea type="textarea" class="form-control" id="description" name="description"
                                          placeholder="{{$page->description}}"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                            <div class="form-group">
                                <label for="image"><i>Image actuelle :</i></label>
                                <br>
                                @if($page->image === 'default_page.png')
                                    <img src="/storage/default/{{ $page->image }}" height="300px">
                                @else
                                    <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}" height="300px">
                                @endif
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
    <script>
        $(document).ready(function () {
            $('#btnBlocText').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.text', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocImage').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.image', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocVideo').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.video', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocScript').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.script', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnSaveBloc').click(function () {
                $('#blocForm').submit();
            })
        });
    </script>
@stop
