@extends('layouts.app')


@section('content')
    <div>
        <div class="container">
            <div class="text-center">
                <b><h1>Gestion des pages dans la collection :</h1></b>
                <button class="btn btn-outline-dark" data-toggle="modal" data-target="#helpModal">Aide</button>
            </div>


        </div>

        <br>
        <div class="col-lg-5 float-left" id="divFreePage">
            <div class="text-center">
                <i><h3>Pages disponibles pour ajouter dans la collection :</h3></i>
                <hr>
                @if(count($pagesAvailables) > 0)
                <div class="text-center">
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
                </div>
                @endif
            </div>
            @if(count($pagesAvailables) > 0)
                <br>
                <x-forms.form route="collection.storePages" parameters="{{ $collection->id }}" noButton="true" id="formAddPages">
                    <div class="row">
                        @foreach($pagesAvailables as $page)
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $page->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="/storage/pages/{{ Auth::user()->id }}/{{ $page->image }}" width="150" height="100">
                                    </div>
                                    <div class="card-footer">
                                        <x-forms.input type="checkbox" name="checkbox[]" value="{{$page->id}}"></x-forms.input>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </x-forms.form>
            @else
                <div class="text-center">
                    <h5>Commencez par créer une nouvelle page : </h5>
                    <a href="{{ route('page.create') }}" class="btn btn-outline-dark">Ici</a>
                </div>
            @endif
        </div>
        @if(count($pagesAvailables) > 0)
            <x-forms.button text="Ajouter" id="btnAddPages"></x-forms.button>
        @endif
        @if(count($pagesInCollection) > 0)
            <x-forms.button text="Supprimer" id="btnDeletePages" class="danger float-right" classIcon="trash"></x-forms.button>
        @endif
        <div class="col-lg-5 float-right" id="divUsedPages">
            <div class="text-center">
                <i><h3>Pages déjà présentes dans la collection :</h3></i>
                <hr>
                @if(count($pagesInCollection) > 0)
                <div class="text-center">
                    <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
                </div>
                @endif
            </div>
            <br>
            @if(count($pagesInCollection) > 0)
                <x-forms.form route="collection.deletePages" parameters="{{ $collection->id }}" noButton="true" id="formDeletePages">
                    <div class="row">
                        @foreach($pagesInCollection as $page)
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $page->page->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="/storage/pages/{{ Auth::user()->id }}/{{ $page->page->image }}" width="150" height="100">
                                    </div>
                                    <div class="card-footer">
                                        <x-forms.input type="checkbox" name="checkbox[]" value="{{$page->page->id}}"></x-forms.input>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </x-forms.form>
            @else
                <div class="text-center">
                    <h5>Aucune page ajoutée dans la collection.</h5>

                </div>
            @endif
        </div>
    </div>

    <!-- help modal -->

    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Fenêtre d'aide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pour ajouter une page dans la collection veuillez cocher la page et cliquer sur le bouton <i>ajouter</i>.</p>
                    <p>Pour supprimer une page de la collection veuillez cocher la page et cliquer sur le bouton <i>supprimer</i>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#btnAddPages').click(function () {
                $('#formAddPages').submit();
            })
            $('#btnDeletePages').click(function () {
                $('#formDeletePages').submit();
            })
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#divFreePage .col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#divUsedPages .col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        })
    </script>
@stop
