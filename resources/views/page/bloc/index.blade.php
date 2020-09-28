
@if(count($page->blocs) > 0)
    <br>
    <div class="row">
        @foreach($page->blocs as $bloc)
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header row w-100">
                        <h5 class="text-center-center">{{ $bloc->title }}</h5>
                        <a class="btn btn-danger text-right" href="{{ route('bloc.destroy',$bloc->id) }}">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                    </div>
                    <div class="w-100">
                        @if($bloc->type == 'text')
                            <textarea class="form-control" onchange="updateBlockText(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                        @endif

                        @if($bloc->type == 'script')
                            <textarea class="form-control" onchange="updateBlockScript(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                        @endif

                        @if($bloc->type == 'image')
                            <img class="text-center" style="margin-top: 5px; margin-bottom: 5px" src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="300" height="180" />
                        @endif

                        @if($bloc->type == 'video')
                            <video style="margin-bottom: 5px" height="180" width="300" controls>
                                <source src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                            </video>
                        @endif
                    </div>
                </div>
                <br>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center">
        <br>
        <h5 style="color: white "><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
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
<style>
    textarea {
        text-align: left;
    }
</style>
