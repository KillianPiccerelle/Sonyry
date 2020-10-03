@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="text-center">
            <h1 style="color: white">Liste de mes pages :</h1>
        </div>
        <br>
        <div class="text-center">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une page..">
        </div>
        <br>
        <div class="row">
            @if(count($pages) > 0)
                @foreach($pages as $page)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $page->title }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    @if($page->image === 'default_page.png')
                                        <img src="/storage/default/{{ $page->image }}" height="150px">
                                    @else
                                        <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}" height="150px">
                                    @endif
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#{{ $page->id }}">
                                        Partager
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Dernière modification : {{ $page->updated_at->format('d/m/y à H\hi') }}</small>
                            </div>
                        </div>
                        <br>
                    </div>

                    <!-- share modal -->
                    <div class="modal fade" id="{{ $page->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Partager la page : {{ $page->title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('share.page', $page->id) }}" class="comment-form contact-form" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="modal-body">
                                        <h5>Sélectionnez le groupe dans lequel vous voulez partager la page :</h5>
                                        <select class="selectpicker" name="group[]" multiple title="Choisir un groupe">
                                            @foreach($page->groups as $group)
                                                <option value="@if($group->status) 0 @else{{ $group->group->id }}@endif" @if($group->status) disabled @endif>{{ $group->group->name }} @if($group->status) <i>(Déjà partagée)</i> @endif</option>
                                            @endforeach
                                        </select>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary float-left">Partager !</button>
                                        <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Pas de pages.</p>
            @endif
        </div>
    </div>




    <script>
        $(document).ready(function(){
            $('.selectpicker').selectpicker();
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });


        });
    </script>

@stop
