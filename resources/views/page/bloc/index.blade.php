
@if(count($page->blocs) > 0)
    <br>
    <div class="row grid-stack">
        @foreach($page->blocs as $bloc)
            <div class="col-sm-5 border">
                <div class="card-header text-center w-100">
                    {{ $bloc->title }}
                    <a class="btn btn-danger float-right" href="{{ route('bloc.destroy',$bloc->id) }}"><i class="fas fa-trash"></i></a>
                </div>
                <div class="w-100 grid-stack-item">

                    @if($bloc->type == 'text')
                        <h5>{{ $bloc->title }} :</h5>
                        <textarea class="form-control" onchange="updateBlockText(this.value,{{ $bloc->id }})">
                            {{ $bloc->content }}
                        </textarea>
                    @endif

                    @if($bloc->type == 'script')
                            <h5>{{ $bloc->title }} :</h5>
                            <textarea class="form-control" onchange="updateBlockScript(this.value,{{ $bloc->id }})">
                            {{ $bloc->content }}
                        </textarea>
                    @endif

                    @if($bloc->type == 'image')
                        <h5>{{ $bloc->title }} :</h5>
                        <img class="text-center" style="margin-top: 5px; margin-bottom: 5px" src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="300" height="180" />
                    @endif

                    @if($bloc->type == 'video')
                            <video style="margin-bottom: 5px" height="180" width="300" controls>
                                <source src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                            </video>
                    @endif

                </div>
                <br>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center">
        <br>
        <h5><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
    </div>
@endif
<script>

    function updateBlockText(textarea,id){

        $.ajax({
            type:'PUT',
            data: {'content':textarea},
            url:"{{route('bloc.update')}}/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
            }
        });
    }

    function updateBlockScript(textarea,id){

        $.ajax({
            type:'PUT',
            data: {'content':textarea},
            url:"{{route('bloc.update')}}/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
            }
        });
    }
</script>
