
@if(count($page->blocs) > 0)
    <br>
    <div class="row">
        @foreach($page->blocs as $bloc)

            @if($bloc->type != null)
                <div class="col-sm-5" >
                    <div class="container border">
                        @if($bloc->type == 'text')

                        @endif
                        @if($bloc->type == 'image')
                            <img src="" />
                        @endif
                    </div>
                </div>
            @else
                <div class="col-sm-5">
                    <button class="container">
                        <p>Configurer le bloc</p>
                    </button>
                </div>

            @endif
        @endforeach
    </div>
@else
    <div class="text-center">
        <br>
        <h5><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
    </div>
@endif

