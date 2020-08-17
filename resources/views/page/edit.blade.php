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
            $("#btnDelete").click(function () {
                $('#modal').modal('show');
            });
            $("#btnEdit").click( function () {
                $('#modalUpdate').modal('show');
            });
        });

        $('#v-pills-tab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show')
        })
    </script>

@stop
