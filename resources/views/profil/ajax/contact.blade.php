<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-pages-tab" data-toggle="tab"
           href="#nav-friend" role="tab" aria-controls="nav-friend" aria-selected="true">Liste
            d'amis</a>

        <a class="nav-item nav-link" id="nav-collections-tab" data-toggle="tab"
           href="#nav-friendAdd" role="tab" aria-controls="nav-friendAdd"
           aria-selected="false">Demande d'amis</a>

        <a class="nav-item nav-link" id="nav-collections-tab" data-toggle="tab"
           href="#nav-others" role="tab" aria-controls="nav-others"
           aria-selected="false">Autres</a>
    </div>
</nav>


<div style="border-bottom: none" class="tab-content" id="nav-tabContent">

    <!------ Demande d'amis ---------->

    <div class="tab-pane fade show active " id="nav-friend" role="tabpanel"
         aria-labelledby="nav-collections-tab">

        @if(count($friends) > 0)

            <table class="table">

                <thead></thead>

                <tbody>
                @foreach($friends as $friend)


                    <tr>
                        <td><p>{{ ucfirst($friend->user->firstName)}}</p></td>
                        <td>
                            <button class="btn btn-danger" type="button" data-toggle="modal"
                                    data-target="#{{$friend->user->id.'_'.$friend->user->firstName}}_delete">
                                Supprimer l'ami
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                         id="{{$friend->user->id.'_'.$friend->user->firstName}}_delete">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Supprimer un ami</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez-vous vraiment
                                        supprimer {{$friend->user->firstName}} de votre
                                        liste d'ami ?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('friend.destroy',$friend->id)}}"
                                       type="button"
                                       class="btn btn-danger">Supprimer</a>
                                    <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                </tbody>

            </table>

        @else
            <p>Vous n'avez pas d'amis</p>
        @endif

    </div>


    <div class="tab-pane fade show " id="nav-friendAdd" role="tabpanel"
         aria-labelledby="nav-collections-tab">

        @if(count($friendRequests) > 0)

            <table class="table">

                <thead></thead>

                <tbody>
                @foreach($friendRequests as $friendRequest)

                    <tr>
                        <td><p>{{ ucfirst($friendRequest->user->firstName)}}</p></td>
                        <td><a href="{{route('friend.add',$friendRequest->id)}}"
                               class="btn btn-primary" type="button">
                                Ajouter
                            </a></td>
                        <td>
                            <a href="{{route('friend.destroy',$friendRequest->id)}}"
                               class="btn btn-danger" type="button">
                                Rejeter
                            </a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>


        @else
            <p>Vous n'avez pas de demande d'ami</p>
        @endif

    </div>

    <div class="tab-pane fade show " id="nav-others" role="tabpanel"
         aria-labelledby="nav-collections-tab">


        <input id="myInput" class="form-control" placeholder="Rechercher un utilisateur">

        <table class="table">

            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th>
            </tr>

            </thead>

            <tbody id="myTable">

            @foreach($valableUsers as $valableUser)

                <tr>
                    <td>{{$valableUser->name}}</td>
                    <td>{{$valableUser->firstName}}</td>
                    <td>
                        @if($valableUser->state)
                            <p>En attente</p>
                        @else

                            <button class="btn btn-primary" type="button"
                                    data-toggle="modal"
                                    data-target="#{{$valableUser->id.'_'.$valableUser->firstName}}_request">
                                Envoyer une demande d'ami
                            </button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1"
                                 role="dialog"
                                 id="{{$valableUser->id.'_'.$valableUser->firstName}}_request">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Envoyer une demande
                                                d'ami</h5>
                                            <button type="button" class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Envoyer une demande d'ami
                                                à {{$valableUser->firstName}}
                                                ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('friend.request',$valableUser->id)}}"
                                               type="button"
                                               class="btn btn-danger">Ajouter</a>
                                            <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Annuler
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </td>


                </tr>


            @endforeach


            </tbody>


        </table>


    </div>

</div>

