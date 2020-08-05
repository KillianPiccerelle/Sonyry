@extends('layouts.app')


@section('content')

    <form method="post" action="{{ route('group.update', $group->id) }}" class="comment-form contact-form"
          enctype="multipart/form-data" id="updateForm">
        @csrf
        @method('PUT')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Paramètrage du groupe</h3>
                <!--Mettre plus tard le bouton supprimer tout a droite-->
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal">
                    Supprimer le groupe
                </button>
                <!--prévoir un bouton retour arrière-->
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
                <!-- /.card-body -->
            </div>
        @if(count($members) > 0)
            <!--prévoir ici une barre de recherche d'utilisateur-->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Membres</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $member->user->name}} {{$member->user->firstName }}</td>
                            <td>
                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target="#kickModal">
                                    Expulser
                                </button>
                            </td>
                        </tr>
                    </tbody>

                    <!-- modal kick  -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="kickModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Expulser du groupe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez-vous vraiment l'expulser du groupe ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" type="button"
                                       class="btn btn-danger">Confirmer</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>
            @else
                <p>Pas de membre dans le groupe</p>
            @endif
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

    <script>
        $(document).ready(function () {
            $('#updateButton').click(function () {
                $('#updateForm').submit();
            })
        })
    </script>
@endsection
