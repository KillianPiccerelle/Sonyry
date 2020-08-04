@extends('layouts.app')


@section('content')

    <link rel="stylesheet" href="/css/inbox.css">


    <div class="container">
        <div class="content">
            <div class="notification-wrapper wrapper">
                <div class="row align-items-stretch">
                    <!--nav-->
                    <div class="sidebar d-none d-lg-block col-md-2 pt-3 bg-white">
                        <ul class="nav nav-tabs" id="navTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab"
                                   aria-controls="inbox" aria-selected="true"><i class="fa fa-envelope"></i> Boîte de
                                    réception</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="favourite-tab" data-toggle="tab" href="#favourite" role="tab"
                                   aria-controls="favorite" aria-selected="false"><i class="fa fa-star"></i> Favoris</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="trash-tab" data-toggle="tab" href="#trash" role="tab"
                                   aria-controls="trash" aria-selected="false"><i class="fa fa-trash"></i> Corbeille</a>
                            </li>
                        </ul>
                    </div>
                    <!--List notification-->
                    <div class="notification-list-container col-md-3 pt-4 pb-4 border-right bg-white">
                        <!--Nav INBOX-->
                        <div class="tab-content" id="tabNotification">
                            <div class="tab-pane fade show active" id="inbox" role="tabpanel"
                                 aria-labelledby="inbox-tab">

                                <ul class="nav flex-column nav-tabs" id="myTab" role="tablist">
                                    @php
                                    $i = 0;

                                    @endphp
                                    @foreach($inboxes as $inbox)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link @if($i === 0) active @endif" id="home-tab" data-toggle="tab" href="#{{ $inbox->notification->id }}"
                                               role="tab" aria-controls="home"
                                               aria-selected="true"> <p class="sender-name"> Système </p>
                                                {{ $inbox->notification->title }}</a>
                                        </li>
                                        @php $i++ @endphp
                                    @endforeach
                                </ul>

                            </div>
                            <div class="tab-pane fade show " id="favourite" role="tabpanel"
                                 aria-labelledby="favourite-tab">
                                <!--Nav FAVORITE-->
                                @foreach($inboxes as $inbox)
                                    <div class="tab-pane fade" id="favorite" role="tabpanel"
                                         aria-labelledby="favorite-tab">
                                        <!-- nav for notification FAVOURITE-->
                                        <ul class="nav nav-tabs" id="favouriteContentTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="favourite-notification-tab"
                                                   data-toggle="tab" href="#"
                                                   role="tab"
                                                   aria-controls="FavouriteContent"
                                                   aria-selected="true">{{ $inbox->notification->paragraph }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade show " id="trash" role="tabpanel" aria-labelledby="trash-tab">
                                <!--NAV TRASH-->
                                @foreach($inboxes as $inbox)
                                    <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
                                        <!-- nav for notification TRASH-->
                                        <ul class="nav nav-tabs" id="trashContentTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="trash-notification-tab" data-toggle="tab"
                                                   href="#"
                                                   role="tab"
                                                   aria-controls="trashContent"
                                                   aria-selected="true">{{ $inbox->notification->created_at }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
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

                            <div class="tab-content" id="myTabContent">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($inboxes as $inbox)
                                    <div class="tab-pane fade show @if($i === 0) active @endif" id="{{ $inbox->notification->id }}" role="tabpanel"
                                         aria-labelledby="{{ $inbox->notification->id }}-tab">
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
                                                <p>{{ $inbox->notification->paragraphe }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++ @endphp
                                @endforeach
                            </div>
                    </div>
                </div>




@endsection
