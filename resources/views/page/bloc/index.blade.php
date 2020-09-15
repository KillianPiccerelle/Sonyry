
@if(count($page->blocs) > 0)
    <br>
    <div class="row">
        @foreach($page->blocs as $bloc)
            <div class="col-sm-5 border">
                <div class="card-header text-center w-100">
                    {{ $bloc->title }}
                </div>
                <div class="w-100">

                    @if($bloc->type == 'text')
                        <textarea class="form-control" id="{{ $bloc->id }}">
                            {{ $bloc->content }}
                        </textarea>
                    @endif

                    @if($bloc->type == 'script')
                            <textarea class="form-control" id="{{ $bloc->id }}" name="content">{{ $bloc->content }}</textarea>

                    @endif

                    @if($bloc->type == 'image')
                        <img class="text-center" src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}" width="100%" height="auto" />
                    @endif

                    @if($bloc->type == 'video')
                            <video height="auto" width="100%" controls>
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
    $(document).ready(function(){
        $('textarea').change(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("i").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", 'bloc/'+this.id+'/update', true);
            xhttp.send();
        })

    })
</script>

<p id="i" hidden></p>



