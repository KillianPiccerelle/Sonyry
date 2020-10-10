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

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            grid-gap: 20px;
        }

        .card {
            display: grid;
            grid-template-rows: max-content 200px 1fr;
            max-height: 300px;
            width: 100%;
            border: solid black 1px;
        }

        .card img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        #card-header {
            border: #303a40;
            background-color: lightgray;
            text-align: center;
        }


    </style>

    <div class="container text-center">
        <div class="text-center">
            <h5 style="color: white;">Titre de la page : <b id="title">{{ $page->title }}</b></h5>
        </div>
        <div>
            <p style="color: white;">Description :</p>
            <p style="color: white;" id="description">{{ $page->description }}</p>
        </div>
        <br>
    </div>

    <div class="container text-center">


        @if(count($page->blocs) > 0)
            <div class="cards">
                @foreach($page->blocs as $bloc)

                    @if($bloc->type == 'text')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>

                            <textarea class="form-control" style="height: 300px" disabled
                                      onchange="updateBlockText(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>

                        </div>


                    @endif
                    @if($bloc->type == 'script')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>
                            <textarea class="form-control" style="height: 300px" disabled
                                      onchange="updateBlockScript(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>

                        </div>
                    @endif
                    @if($bloc->type == 'image')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>
                            <img id="img" class="text-center" style="margin-top: 5px; margin-bottom: 5px"
                                 src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}"
                                 width="300px"
                                 height="180"/>
                        </div>
                    @endif
                    @if($bloc->type == 'video')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>
                            <video style="margin-bottom: 5px" controls>
                                <source
                                    src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                            </video>
                        </div>
                    @endif
                @endforeach


            </div>
            <br>


        @else
            <div class="container text-center">
                <br>
                <h5 style="color: white "><i>Vous n'avez pas de bloc dans cette page veuillez en créer un
                        !</i></h5>
            </div>
        @endif
    </div>


@endsection
