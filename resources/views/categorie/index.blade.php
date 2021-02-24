@extends('layouts.app')

@php
    $title = 'Catégorie';

    if (count($categories) > 0){
        $title .= 's';
    }
@endphp


@section('content')

    <div class="container">
        <div class="d-flex row" style="justify-content: center">
            <div class=" list-group " style="width: 70%; ">
                <p style="color: white; font-size: x-large">{{ $title }}</p>
                @forelse($categories as $categorie)
                    <div class="list-group-item">
                        <h5 class="card-title">{{ $categorie->libelle }}</h5>
                        <small>Posté le {{ date('d/m/Y à H:m', strtotime($categorie->created_at)) }}</small>
                        <div class="align-items-center float-right">
                            <button type="submit" data-target="#staticBackdrop" data-toggle="modal"
                                    class="btn btn-danger">
                                Supprimer
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                         tabindex="-1"
                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title" id="staticBackdropLabel">Supprimer la catégorie
                                        "{{ $categorie->libelle }}"</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez vous vraiment supprimer cette catégorie ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="{{ route('categorie.destroy',$categorie->id) }}" type="button"
                                       class="btn btn-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty

                @endforelse
            </div>
        </div>
    </div>

    <hr>

    <div class="container text-center">
        <a href="{{ route('categorie.create') }}" class="btn btn-primary text-center"
           style="color: white; width: 30%" type="submit">Créer une catégorie</a>
    </div>



@endsection
