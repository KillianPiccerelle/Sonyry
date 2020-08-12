@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-sm-1 border-right">
        @include('incs.auth.group.navbar')
    </div>
    <div class="container text-center">
        <h1>{{ $group->name }}</h1>
        <p>Crée le : {{ $group->created_at->format('d/m/y') }}</p>
        <hr>
        <h5 class="text-center">Membre(s) du groupe :</h5>
        <br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Prénom</th>
                <th scope="col">Statut</th>
                <th scope="col">Date d'arrivée dans le groupe</th>
                @can('can-edit-group',$group->user_id)
                <th scope="col">Action</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
            <tr>
                <th scope="row">{{ $member->user->name }}</th>
                <td>@if($member->user->id === $group->user_id)
                        Propriétaire
                    @else
                        Membre
                    @endif
                </td>
                <td>{{ $member->created_at->format('d/m/y') }}</td>
                @can('can-edit-group',$group->user_id)
                    <td>
                        @if($member->user->id !== $group->user_id)
                            <button class="btn btn-danger" data-toggle="modal" data-target="#kick-{{ $member->user->id }}">
                                Exclure
                            </button>


                            <!-- kick group modal -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="kick-{{ $member->user->id }}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Exclure du groupe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Voulez-vous vraiment exclure <b>{{ $member->user->name }}</b> du groupe <b>{{ $group->name }}</b> ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('group.kick', [
                                                    'id'=>$group->id,
                                                    'user_id'=>$member->user->id
                                                ]) }}" class="btn btn-danger">Exclure</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                @endcan
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
