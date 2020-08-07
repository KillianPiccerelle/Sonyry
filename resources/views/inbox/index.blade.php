@extends('layouts.app')


@section('content')

    <link rel="stylesheet" href="/css/inbox.css">


    <div class="container">
        <div class="content">
            <div class="notification-wrapper wrapper">
                <div class="row align-items-stretch">
                    <!--nav-->
                    <div class="sidebar d-none d-lg-block col-md-2 pt-3 bg-white">
                        <ul class="nav nav-tabs" id="navTabPrimary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab"
                                   aria-controls="inbox" aria-selected="true"><i class="fa fa-envelope"></i> Boîte de
                                    réception</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="favourite-tab" data-toggle="tab" href="#favourite" role="tab"
                                   aria-controls="favourite" aria-selected="false"><i class="fa fa-star"></i> Favoris</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="trash-tab" data-toggle="tab" href="#trash" role="tab"
                                   aria-controls="trash" aria-selected="false"><i class="fa fa-trash"></i> Corbeille</a>
                            </li>
                        </ul>
                    </div>
                    <!--List notification-->
                    <div class="notification-list-container col-md-3 pt-4 pb-4 border-right bg-white">

                        <div class="tab-content" id="navTabPrimaryContent">
                            <!--Nav INBOX-->
                            <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">

                                <ul class="nav nav-tabs flex-column" id="navTabSecondary" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="welcome-tab" data-toggle="tab" href="#welcome" role="tab" aria-controls="welcome" aria-selected="true">
                                            <p class="sender-name">Système</p> Bienvenue
                                        </a>
                                    </li>
                                    @php $id = 0 @endphp
                                    @foreach($inboxes as $inbox)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="id{{$id}}-tab" data-toggle="tab" href="#id{{$id}}" role="tab" aria-controls="id{{$id}}" aria-selected="true">
                                            <p class="sender-name">Système</p> {{ $inbox->notification->title }}
                                        </a>
                                    </li>
                                        @php $id++ @endphp
                                    @endforeach
                                </ul>

                            </div>

                            <!--Nav FAVOURITE-->
                            <div class="tab-pane fade" id="favourite" role="tabpanel" aria-labelledby="favourite-tab">
                                Test 2
                            </div>

                            <!--Nav TRASH-->
                            <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
                                Test 3
                            </div>
                        </div>
                    </div>

                    <!--Body notification-->
                    <div class="notification-view d-none d-md-block col-md-9 col-lg-7 bg-white">
                        <div class="row">
                            <div class="col-md-2 mb-4 mt-4">
                                <div class="btn-toolbar">
                                    <a class="btn btn-sm btn-outline-secondary" href="#">
                                        <i class="fa fa-trash text-primary mr-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="navTabSecondaryContent">
                            <div class="tab-pane fade show active" id="welcome" role="tabpanel" aria-labelledby="welcome-tab">
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
                                        <p>Bonjour, merci à vous de nous avoir rejoins</p>
                                    </div>
                                </div>
                            </div>
                            @php $id = 0 @endphp
                            @foreach($inboxes as $inbox)
                            <div class="tab-pane fade" id="id{{$id}}" role="tabpanel" aria-labelledby="id{{$id}}-tab">
                                <div class="notification-body">
                                    <div class="sender-details">
                                        <img class="img-sm rounded-circle mr-3" width="100" height="100"
                                             src="/img/avatar.default.jpg" alt="">
                                        <div class="details">
                                            <p class="msg-subject">{{ $inbox->notification->title }} {{ $inbox->notification->created_at }}</p>
                                            <p class="sender-notification">Système</p>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p>{{ $inbox->notification->paragraph }}</p>
                                    </div>
                                </div>
                            </div>
                                @php $id++ @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
