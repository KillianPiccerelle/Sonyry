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
        }

        .card img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }


    </style>

    <div class="container text-center">

        <div class="cards">
            @if(count($page->blocs) > 0)
                @foreach($page->blocs as $bloc)
                    @if($bloc->type == 'text')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" disabled
                                          onchange="updateBlockText(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                            </div>
                        </div>


                    @endif
                    @if($bloc->type == 'script')
                        <div class="card">
                            <div id="card-header">
                                <h5 class="text-center-center">{{ $bloc->title }}</h5>
                            </div>
                            <textarea class="form-control" disabled
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

                <div id="card-footer"
                     style="background: linear-gradient(70deg, black, lightgrey);">
                    <small>Dernière modification : 09/10/20 à 19h27</small>
                </div>
        </div>
        <br>

    </div>



    @else
        <div class="text-center">
            <br>
            <h5 style="color: white "><i>Vous n'avez pas de bloc dans cette page veuillez en créer un
                    !</i></h5>
        </div>
        @endif
        </div>
@endsection
