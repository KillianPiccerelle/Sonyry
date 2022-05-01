@extends('layouts.app')


@section('content')
    <div>

        <!-- header of this page -->
        <div class="container">
            <div class="text-center">
                <b><h1 style="color: white">Gestion des pages dans la collection :</h1></b>
                <button class="btn btn-outline-warning float-right" data-toggle="modal" data-target="#helpModal">
                    <i class="fas fa-info-circle"></i>
                    Aide
                </button>
                <a class="btn btn-outline-primary float-left" href="{{ route('collection.edit', $collection->id) }}">
                    <i class="fas fa-arrow-circle-left"></i>
                    Revenir à la collection
                </a>
            </div>
        </div>
        <br><br><hr style="border: white"><br>


        <!-- add pages div-->
        <div class="col-lg-5 float-left ml-5" id="divFreePage">
            <div class="text-center">
                <div class="float-left">
                    @if(count($collection->availables) > 0)
                        <x-forms.button text="Ajouter" id="btnAddPages"></x-forms.button>
                    @endif
                </div>
                <i><h3 style="color: white">Pages disponibles pour ajouter dans la collection :</h3></i>
                <hr style="color: white">
                @if(count($collection->availables) > 0)
                <div class="text-center">
                    <input class="form-control" id="pageFreeInput" type="text" placeholder="Rechercher une page..">
                </div>
                @endif
            </div>
            @if(count($collection->availables) > 0)
                <br>
                <x-forms.form route="collection.storePages" parameters="{{ $collection->id }}" noButton="true" id="formAddPages">
                    <div class="row">
                        @foreach($collection->availables as $page)
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $page->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                            <img src="{{ env('API_BASE_URL') . '/../' . $page->link }}" height="100px">
                                    </div>
                                    <div class="card-footer">
                                        <x-forms.input type="checkbox" name="checkbox[]" id="checkboxAddPages" value="{{$page->id}}"></x-forms.input>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </x-forms.form>
            @else
                <div class="text-center">
                    <h5 style="color: white">Commencez par créer une nouvelle page : </h5>
                    <a href="{{ route('page.create') }}" class="btn btn-outline-dark">Ici</a>
                </div>
            @endif
        </div>


        <!-- delete pages div -->
        <div class="col-lg-5 float-right mr-5" id="divUsedPages">
            <div class="text-center">
                <div class="float-left">
                    @if(count($collection->pages) > 0)
                        <x-forms.button text="Supprimer" id="btnDeletePages" class="danger float-right" classIcon="trash"></x-forms.button>
                    @endif
                </div>
                <i><h3 style="color: white">Pages déjà présentes dans la collection :</h3></i>
                <hr>
                @if(count($collection->pages) > 0)
                <div class="text-center">
                    <input class="form-control" id="pageUsedInput" type="text" placeholder="Rechercher une page..">
                </div>
                @endif
            </div>
            <br>
            @if(count($collection->pages) > 0)
                <x-forms.form route="collection.deletePages" parameters="{{ $collection->id }}" noButton="true" id="formDeletePages">
                    <div class="row">
                        @foreach($collection->pages as $page)
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h5 class="card-title">{{ $page->page->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ env('API_BASE_URL') . '/../' . $page->page->link }}" height="100px">
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
                    <h5 style="color: white">Aucune page ajoutée dans la collection.</h5>

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#btnAddPage').click(function () {
                $('#formAddPages').submit();
            })
            $('#btnDeletePages').click(function () {
                $('#formDeletePages').submit();
            })
            $("#pageFreeInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#divFreePage .col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $("#pageUsedInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#divUsedPages .col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


            $('#btnAddPages').click(function (e) {
                $('#formAddPages').submit();
            })



        })
    </script>
@stop
