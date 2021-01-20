<br>
<div class="row">
    @forelse($page->blocs as $bloc)
        <div class="col-md-4">
            <div class="card text-center" id="card">
                <div class="card-header" onclick="openNavUpdate(this,{{ $bloc->id }})">
                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                </div>
                <div class="card-body">
                    @if($bloc->type == 'text')
                        <textarea class="form-control" id="content"
                                  onchange="updateBlockText(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                    @endif

                    @if($bloc->type == 'script')
                        <textarea class="form-control" id="content"
                                  onchange="updateBlockScript(this.value,{{ $bloc->id }})">{{ $bloc->content }}</textarea>
                    @endif

                    @if($bloc->type == 'image')
                        <img class="text-center" id="content"
                             src="/storage/bloc/{{ $bloc->page_id }}/image/{{ $bloc->content }}"
                             onclick="openModalImage(this,'{{$bloc->title}}')"/>
                    @endif

                    @if($bloc->type == 'video')
                        <video id="content" controls>
                            <source src="/storage/bloc/{{ $bloc->page_id }}/video/{{ $bloc->content }}">
                        </video>
                    @endif
                    @if($bloc->type == 'file')
                       <a href="/storage/bloc/{{ $bloc->page_id }}/file/{{ $bloc->content }}" download>{{ $bloc->content }}</a>
                    @endif
                </div>
            </div>
            <br>
        </div>
    @empty
        <div class="container text-center">
            <br>
            <h5 style="color: white "><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
        </div>
    @endforelse
</div>

