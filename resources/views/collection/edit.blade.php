@extends('layouts.app')


@section('content')

    <div class="container text-center">
        <div class="text-center">
            <h5>Titre de la collection : <b>{{ $collection->name }}</b></h5>
        </div>
        <div>
            <p>Description :</p>
            <p>{{ $collection->description }}</p>
        </div>
        <br>
        <hr>

        <div class="form-row">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
        </div>
        <br>
        <div class="row">
            <a href="{{ route('collection.addPages', $collection->id) }}" class="card bg-light mb-3 border" style="max-width: 18rem;" id="btnAddPage">
                <div class="card-header">Gerer les pages dans la collection</div>
                <div class="card-body">
                    <p>Ajoutez ou supprimez des pages</p>
                    <br>
                    <i class="fas fa-plus" style="size: A3"></i>
                </div>
            </a>
            @if(count($pages) > 0)
                @foreach($pages as $page)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $page->page->title }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    @if($page->image === 'default_page.png')
                                        <img src="/storage/default/{{ $page->page->image }}" height="150px">
                                    @else
                                        <img src="/storage/pages/{{ $page->page->user_id }}/{{ $page->page->image }}" height="150px">
                                    @endif
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="{{ route('page.edit', $page->page->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        Éditer
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Dernière modification : {{ $page->updated_at->format('d/m/y à H\hi') }}</small>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                <p>Pas de pages.</p>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@stop
