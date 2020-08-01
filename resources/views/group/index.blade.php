@extends('layouts.app')


@section('content')

        @if(count($groups) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom du groupe</th>
                    <th scope="col">Nombre de personnes dans le groupe</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)

                    <tr>
                        <td>{{ $group->group->name }}</td>
                        <td>{{ $group->members }}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#settingModal">
                                Paramétrer
                            </button>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#exitModal">
                                Quitter
                            </button>
                        </td>
                    </tr>
                    <!-- modal exit group  -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exitModal">
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
                                    <a href="{{route('group.destroy', $group->id)}}" type="button"
                                       class="btn btn-danger">Supprimer</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <td>Vous n'appartenez actuellement à aucun groupe.</td>
                @endif

            </table>















@endsection
