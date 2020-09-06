
@if(count($page->blocs) > 0)
    <br>
    <div class="row">
        @foreach($page->blocs as $bloc)
            <div class="col-sm-5" >
                <div class="container border">
                    @if($bloc->type == 'text')
                        <textarea class="form-control">
                            {{ $bloc->content }}
                        </textarea>
                    @endif
                    @if($bloc->type == 'script')
                            <textarea class="form-control">
                            {{ $bloc->content }}
                        </textarea>
                    @endif
                    @if($bloc->type == 'image')
                        <img class="text-center" src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="300" height="180" />
                    @endif
                    @if($bloc->type == 'video')
                            <video height="180" width="300" controls>
                                <source src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                            </video>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center">
        <br>
        <h5><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
    </div>
@endif

