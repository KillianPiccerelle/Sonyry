
@if(count($page->blocs) > 0)
    <br>
    <div class="row">
        @foreach($page->blocs as $bloc)
            <div class="col-sm-5" >
                <div class="container border" style="margin-bottom: 15px">
                    @if($bloc->type == 'text')
                        <h5>{{ $bloc->title }} :</h5>
                        <textarea class="form-control">
                            {{ $bloc->content }}
                        </textarea>
                    @endif
                    @if($bloc->type == 'script')
                            <h5>{{ $bloc->title }} :</h5>
                            <textarea class="form-control">
                            {{ $bloc->content }}
                        </textarea>
                    @endif
                    @if($bloc->type == 'image')
                        <h5>{{ $bloc->title }} :</h5>
                        <img class="text-center" style="margin-top: 5px; margin-bottom: 5px" src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="300" height="180" />
                    @endif
                    @if($bloc->type == 'video')
                            <h5>{{ $bloc->title }} :</h5>
                            <video style="margin-bottom: 5px" height="180" width="300" controls>
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

