@extends('layouts.app')


@section('content')

    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        #flex {

            display: flex;
            justify-content: space-evenly;
            flex-direction: row;


        }

        .card {
            width: 300px;
            max-height: 300px;
        }


    </style>

    <div class="container text-center">
        <div class="text-center">
            <h5 style="color: white;">Titre de la page : <b id="title">{{ $page->title }}</b></h5>
        </div>
        <div style="color: white">
            <p>Description :</p>
            <p id="description">{{ $page->description }}</p>
        </div>
        <br>

        <div class="row" id="flex">

                @if(count($page->blocs) > 0)

                    @foreach($page->blocs as $bloc)


                        @if($bloc->type == 'text')
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                                </div>
                                <textarea class="form-control" disabled
                                          onchange="updateBlockText(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                            </div>
                        @endif


                        @if($bloc->type == 'script')
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                                </div>
                                <textarea class="form-control" disabled
                                          onchange="updateBlockScript(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                            </div>
                        @endif


                        @if($bloc->type == 'image')
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                                </div>
                                <img class="text-center" style="margin-top: 5px; margin-bottom: 5px"
                                     src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="300px"
                                     height="180"/>
                            </div>
                        @endif

                        @if($bloc->type == 'video')
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                                </div>
                                <video style="margin-bottom: 5px" controls>
                                    <source src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                                </video>
                            </div>
                        @endif

                    @endforeach

        </div>
    </div>

    @else
        <div class="text-center">
            <br>
            <h5 style="color: white "><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
        </div>
        @endif
        </div>
@endsection
