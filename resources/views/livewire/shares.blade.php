<div>
    <div>
        @if (session()->has('livewire'))
            <div class="alert alert-success">
                {{ session('livewire') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="container-fluid">
        @include('incs.auth.share.navbar')
    </div>
    <br>
    <div class="container-fluid">
        <a href="#" wire:click="switchDirectory(0)">Home</a>
        @if(count($links) > 0)
            @forelse($links as $link)
                / <a href="#" style="color: #3490dc; -webkit-appearance: meter" wire:click="switchDirectory({{ $link->id }})">{{ $link->name }}</a>
            @empty

            @endforelse
        @endif
        <i> (dossier actuel)</i>
    </div>
    <div class="container-fluid">
        @forelse($content as $item)
            @if($item->type == 'page')
                <div class="row ml-sm-1 justify-content-between">
                    <a href="{{ route('page.edit',$item->page->id) }}" style="width: 90%" class="list-group-item list-group-item-action">
                        <i class="fas fa-file"></i>
                        {{ $item->page->title }}
                        <i class="float-right">De : {{ $item->page->user->name }}</i>
                    </a>
                    <button class="btn btn-danger" wire:click="deleteShare({{$item->id}})">Supprimer</button>
                </div>
            @elseif($item->type == 'directory')
                <div class="row ml-sm-1 justify-content-between">
                    <button wire:click="switchDirectory({{ $item->id }})" style="width: 90%" class="list-group-item list-group-item-action">
                        <i class="fas fa-folder"></i>
                        {{ $item->name }}
                    </button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDirectoryModal{{ $item->id }}"  >Supprimer</button>
                </div>

                <div wire:ignore.self class="modal fade" id="deleteDirectoryModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer un dossier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer le dossier ainsi que tout  les éléments qu'ils contient ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                <button type="button" data-dismiss="modal" wire:click="deleteDirectory({{ $item->id }})" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <br>
        @empty
            Aucun fichier dans ce dossier
        @endforelse
    </div>


    <div wire:ignore.self class="modal fade" id="newDirectory" tabindex="-1" role="dialog" aria-labelledby="newDirectory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un dossier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nom du dossier</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nom..." wire:model="directoryName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close-btn" data-dismiss="modal">Terminer</button>
                    <button type="button" id="btnStore" wire:click.prevent="store()" class="btn btn-primary close-modal">Ajouter !!!</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="sharePages" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    Partager des pages :
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        @forelse($pages as $page)
                            <div class="row ml-1 mr-1 justify-content-between">
                                <div class="list-group-item" data-toggle="collapse" data-target="#collapse{{ $page->id }}" aria-expanded="true" aria-controls="collapse{{ $page->id }}" style="width: 80%">{{ $page->title }}</div>
                                @if($page->isShared)
                                    <p><i>Déjà partagée</i></p>
                                @else
                                    <input wire:model="pagesShared" value="{{ $page->id }}" type="checkbox">

                                @endif
                            </div>
                            <div id="collapse{{ $page->id }}" class="collapse" aria-labelledby="headingOne">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <h5>Page : {{ $page->title }}</h5>
                                            <hr>
                                            @if($page->image === 'default_page.png')
                                                <img src="/storage/default/{{ $page->image }}" style="width: 50%; height: auto">
                                            @else
                                                <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}" style="width: 100%; height: auto">
                                            @endif
                                        </div>
                                        <div class="col-5">
                                            <h5>Description :</h5>
                                            <hr>
                                            <p>{{ $page->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="resetShares" data-dismiss="modal" class="btn btn-danger">Annuler</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click="sharePages">Ajouter !</button>
                </div>
            </div>
        </div>
    </div>




</div>


