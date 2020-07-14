@extends('layouts.app')


@section('content')

    <div class="row">
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        </div>
        <div class="container border text-center">
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
                    <button class="btn btn-dark text-left" id="btnEdit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        Editer la page
                    </button>
                    <button class="btn btn-secondary text-center" onclick="openNav()">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Nouveau bloc
                    </button>
                <button class="btn btn-danger text-right" id="btnDelete">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    Supprimer la page
                </button>
            </div>
        </div>
        <div class="col-sm-2 border" hidden>

        </div>
    </div>

    <!-- Suppression modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modal">
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
                    <a href="{{route('page.delete', $page->id)}}" type="button" class="btn btn-danger">Supprimer</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- update modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-2" role="dialog" id="modalUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('page.update', $page->id) }}" class="comment-form contact-form" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="title" name="title" placeholder="{{ $page->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description de la page</label>
                                <textarea type="textarea" class="form-control" id="description" name="description" placeholder="{{$page->description}}"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                            <div class="form-group">
                                <label for="image"><i>Image actuelle :</i></label>
                                <br>
                                <img src="/storage/pages/{{ Auth::user()->id }}/{{ $page->image }}">
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
        function openNav() {
            document.getElementById("mySidenav").style.width = "350px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
        $(document).ready(function () {
            $("#btnDelete").click(function () {
                $('#modal').modal('show');
            });
            $("#btnEdit").click( function () {
                $('#modalUpdate').modal('show');
            });
        });
    </script>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: auto;
            left: 0;
            background-color: lightgrey;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>

@stop
