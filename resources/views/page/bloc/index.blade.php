<br>
<div class="row">
    @forelse($page->blocs as $bloc)
        <div class="col-sm-5">
            <div class="card" id="card" >
                <div class="card-header" onclick="openNav(this,{{ $bloc->id }})">
                    <h5 class="text-center-center">{{ $bloc->title }}</h5>
                </div>
                </div>
                <div class="card-body w-100">
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
        </div>
        <br>
    @empty
    </div>
    <div class="text-center">
        <br>
        <h5><i>Vous n'avez pas de bloc dans cette page veuillez en créer un !</i></h5>
    </div>
    @endforelse
</div>

