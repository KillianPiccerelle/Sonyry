<div class="notification-view d-none d-md-block col-md-9 col-lg-7 bg-white">

    <div class="tab-content" id="navTabSecondaryContent">
        <div class="tab-pane fade show active" id="welcome" role="tabpanel"
             aria-labelledby="welcome-tab">
            <div class="notification-body">
                <div class="sender-details">
                    <img class="img-sm rounded-circle mr-3" width="100" height="100"
                         src="/img/avatar.default.jpg" alt="">
                    <div class="details">
                        <p class="msg-subject">Bienvenue</p>
                        <p class="sender-notification">Système</p>
                    </div>
                </div>
                <div class="message-content">
                    <p>Bonjour, merci à vous de nous avoir rejoint, nous espérons que vous apprécierez
                        le service mis en place pour la création de votre portfolio en ligne.
                        Pour toutes détections d'éventuels bugs ou demandes complémentaires veuillez contacter
                        Mr. Martineau, Mr. Piccerelle, Mr. Alexandre ou à l'administrateur.
                        Nous vous souhaitons une agréable continuation.
                    </p>
                </div>
            </div>
        </div>
        @php $id = 0 @endphp
        @foreach($inboxes as $inbox)
            <div class="tab-pane fade" id="id{{$id}}" role="tabpanel"
                 aria-labelledby="id{{$id}}-tab">
                @if($inbox->notification->trash == 0)
                    <div class="row">
                        <div class="col-md-2 mb-4 mt-4">
                            <div class="btn-toolbar">
                                <a class="btn btn-sm btn-outline-secondary"
                                   wire:click="toTrash({{ $inbox->notification->id }})">
                                    <i class="fa fa-trash text-primary mr-1"></i> Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-2 mb-4 mt-4">
                            <div class="btn-toolbar">
                                <a class="btn btn-sm btn-outline-secondary"
                                   wire:click="destroy({{ $inbox->notification->id }})">
                                    <i class="fa fa-trash text-primary mr-1"></i> Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="notification-body">
                    <div class="sender-details">
                        <img class="img-sm rounded-circle mr-3" width="100" height="100"
                             src="/img/avatar.default.jpg" alt="">
                        <div class="details">
                            <p class="msg-subject">{{ $inbox->notification->title }} {{ $inbox->notification->created_at->format('d/m/y à H\hi') }}</p>
                            <p class="sender-notification">Système</p>
                        </div>
                    </div>
                    <div class="message-content">
                        <p>{{ $inbox->notification->paragraph }}</p>
                        @if(isset($inbox->notification->link))
                            <a class="btn btn-primary" href="{{$inbox->notification->link}}">Rejoindre</a>
                        @endif
                    </div>
                </div>
            </div>
            @php $id++ @endphp
        @endforeach
    </div>
</div>
