
@if(count($page->blocs) > 0)

    <div class="row">
        @foreach($page->blocs as $bloc)

            <div class="col-sm-5 border mt-1" >
                <p>{{ $bloc->id }}</p>
            </div>
        @endforeach
    </div>


@else
    <div class="text-center">
        <br>
        <h5><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
    </div>
@endif
