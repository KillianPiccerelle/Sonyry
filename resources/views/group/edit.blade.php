@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="container">
            <form method="post" action="{{ route('group.update', $group->id) }}" class="comment-form contact-form"
                  enctype="multipart/form-data" id="updateForm">
                @csrf
                @method('PUT')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-center">Paramètrage du groupe : {{ $group->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nom du groupe</label>
                            <input name="name" type="text" id="inputName" class="form-control"
                                   value="{{ $group->name }}">
                        </div>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#confirmModal">
                            Sauvegarder
                        </button>
                        <button class="btn btn-danger float-right" type="button" data-toggle="modal" data-target="#deleteModal">
                            Supprimer le groupe
                        </button>
                    </div>
                </div>
            </form>


            <!-- modal update  -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="confirmModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Enregistrer les modifications</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment enregistrer les modifications ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton"
                                    class="btn btn-primary">Enregistrer</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal delete group  -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="deleteModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer le groupe</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment supprimer le groupe ?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('group.destroy', $group->id) }}" type="button"
                               class="btn btn-danger">Supprimer</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#updateButton').click(function () {
                $('#updateForm').submit();
            })
        })
    </script>
@endsection
