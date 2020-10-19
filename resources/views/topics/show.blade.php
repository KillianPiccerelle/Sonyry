@extends('layouts.app')

@section('content')
    <script>
        /**
         * Apparition, disparition button
         */
        function toggleReplyComment(id) {
            let element = document.getElementById('replyComment-' + id);
            element.classList.toggle('d-none');
        }

    </script>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $topic->title }}</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                    <span class="badge badge-primary">{{ $topic->user->name }}</span>
                </div>
                @if($topic->user_id == Auth::user()->id)
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-warning">Editer ce topic</a>
                        <button type="submit" data-target="#staticBackdrop" data-toggle="modal" class="btn btn-danger">Supprimer</button>

                    </div>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Supprimer un Topic</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Voulez vous vraiment supprimer ce topic ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a href="{{ route('topics.destroy',$topic->id) }}" type="button" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h5 style="color: white">Commentaires</h5>
        @forelse($topic->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    {{ $comment->content }}
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{ $comment->created_at->format('d/m/Y') }}</small>
                        <span class="badge badge-primary">{{ $comment->user->name }}</span>
                    </div>
                </div>
            </div>
            @foreach($comment->comments as $replyComment)
                <div class="card mb-2 ml-5">
                    <div class="card-body">
                        {{ $replyComment->content }}
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Posté le {{ $replyComment->created_at->format('d/m/Y') }}</small>
                            <span class="badge badge-primary">{{ $comment->user->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            @auth
                <button class="btn btn-info mb-3" onclick="toggleReplyComment({{ $comment->id }})">Répondre</button>
                <form action="{{ route('comments.storeReply' ,$comment->id) }}" class="mb-3 ml-5 d-none"
                      id="replyComment-{{$comment->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="color: white" for="replyComment">Ma réponse</label>
                        <textarea name="replyComment" class="form-control @error('replyComment') is-invalid @enderror "
                                  id="replyComment" cols="30" rows="5"></textarea>
                        @error('replyComment')
                        <div class="invalid-feedback">{{ $errors->first('replyComment') }}</div>

                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Répondre à ce commentaire</button>
                </form>
            @endauth

        @empty
            <div class="alert alert-info">Aucun commentaire pour ce topic</div>
        @endforelse


        <form action="{{ route('comments.store', $topic->id) }}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label style="color: white" for="content">Votre commentaire</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
                          rows="5"></textarea>
                @error('content')
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button style="color: white" type="submit" class="btn btn-primary">Soumettre mon commentaire</button>

        </form>
    </div>

@endsection
