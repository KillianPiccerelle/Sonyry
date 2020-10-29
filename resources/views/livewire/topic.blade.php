<div>

    <style>
        .li:hover {
            color: white;
            background-color: #A9A9A9;
        }
    </style>

    <div class="container-fluid pl-5">
        <div class="row">
            <div class="list-group" style="width: 20%; margin-right: 150px">
                <div class="row ml-0 mr-0">
                    <p style="color: white; font-size: x-large">Catégories</p>
                    <a href="{{ route('categorie.index') }}" class="btn btn-primary h-75 text-center" style="margin-left: 26%" type="submit">Gérer les catégories</a>
                </div>

                @if(count($categories) > 0)
                    <li @if($current == 0) style="background-color: #A9A9A9" @endif wire:click="switchCategorie(0)"
                        class="list-group-item li"><p>Voir tout les topics</p></li>
                @endif
                @foreach($categories as $categorie)
                    <li @if($current == $categorie->id) style="background-color: #A9A9A9"
                        @endif wire:click="switchCategorie({{ $categorie->id }})" class="list-group-item li">
                        <p>{{ $categorie->libelle }}</p></li>
                @endforeach
            </div>
            <div class="list-group pb-5 pr-5" style="width: 60%">
                <p style="color: white; font-size: x-large">Sujets</p>
                @if(count($topics) > 0)
                    @foreach($topics as $topic)
                        <div class="list-group-item">
                            <h4><a href="{{ route('topics.show',$topic['id']) }}">{{ $topic->title }}</a></h4>
                            <p>{{ $topic->content }}</p>
                            <div class="align-items-center">
                                <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                                <span class="badge badge-primary float-right">{{ $topic->user->name }}</span>
                                @if($current == 0) <span
                                    class="badge badge-warning float-right">{{ $topic->categorie->libelle}}</span> @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <a href="{{ route('topics.create') }}" class="btn btn-primary h-50 text-center w-25" style="color: white" type="submit">Veuillez créer un topic</a>
                @endif

            </div>
        </div>
    </div>

</div>
