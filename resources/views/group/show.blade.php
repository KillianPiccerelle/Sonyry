@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="container text-center" style="color: white">
            <h1>{{ $group->name }}</h1>
            <p>Crée le : {{ $group->created_at->format('d/m/y') }}</p>
            <hr>
            <h5 class="text-center">Membre(s) du groupe :</h5>
            <br>
            @if(count($users) > 0)
                <button style="float: right; margin-bottom: 15px" class="btn btn-primary" data-toggle="modal"
                        data-target="#invite">
                    Inviter un utilisateur
                </button>
            @endif
            <table class="table" style="color: white">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Prénom</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date d'arrivée dans le groupe</th>
                    @can('can-edit-group',$group)
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
                        @can('can-edit-group',$group)
                            <td>
                                @if($member->user->id !== $group->user_id)
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#kick-{{ $member->user->id }}">
                                        Exclure
                                    </button>


                                    <!-- kick group modal -->
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                         id="kick-{{ $member->user->id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="color: black" class="modal-title">Exclure du groupe</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="color: black">Voulez-vous vraiment exclure
                                                        <b>{{ $member->user->name }}</b> du groupe
                                                        <b>{{ $group->name }}</b> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('group.kick', [
                                                    'id'=>$group->id,
                                                    'user_id'=>$member->user->id
                                                ]) }}" class="btn btn-danger">Exclure</a>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Annuler
                                                    </button>
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
            @if(count($users) > 0)
            <!-- invite group modal -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="invite">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Inviter un utilisateur</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                   href="{{route('group.invite', ['id'=>$group->id, 'user_id'=>$user->id ])}}"
                                                   role="button">Inviter</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@stop
