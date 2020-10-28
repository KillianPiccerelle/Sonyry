@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                @foreach($categories as $categorie)
                    <h5 class="card-title">{{ $categorie->libelle }}</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{ $categorie->created_at->format('d/m/Y à H:m') }}</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="submit" data-target="#staticBackdrop" data-toggle="modal" class="btn btn-danger">
                            Supprimer
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Supprimer une catégorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Voulez vous vraiment supprimer cette catégorie ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a href="{{ route('categorie.destroy',$categorie->id) }}" type="button" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
