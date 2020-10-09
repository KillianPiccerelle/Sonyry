@extends('layouts.app')


@section('content')
    <style>
        body, html {
            margin: 0;
            padding: 0;
            min-height: 100%;
            overflow-x: hidden;
        }


        body {
            position: relative;
            width: 100%;
            height: 100%;
            background: linear-gradient(0.25deg, #3f87a6 , #ebf8e1 , #f69d3c);


        }

        /* Sidebard */

        .notification-wrapper .sidebar {

        }


        .notification-wrapper .sidebar .nav {
            width: 100%;
            float: right;
            height: 100%;
            border: none;
            position: absolute;
        }

        .notification-wrapper .sidebar .nav .nav-item{
            padding: 0;
            margin-bottom: 0;
            height: auto;
            width: 100%;

        }

        .notification-wrapper .sidebar .nav .nav-item:hover{
            background: rgba(240, 244, 249, 0.8);
        }


        .notification-wrapper .sidebar .nav .nav-item a{
            color: #303a40;
            font-size: 0.75rem;
            text-decoration: none;
        }

        .notification-wrapper .sidebar .nav .nav-item li a i {
            margin-right: 8px;
            font-size: 0.75rem;
            line-height: 1.5;
        }

        .notification-wrapper .sidebar .nav .nav-item li.active {
            background: #e6e9ed;
            border-radius: 4px;
        }

        .notification-wrapper .sidebar .nav .nav-item li.active a {
            color: #464dee;
        }

        .notification-wrapper .sidebar .nav .nav-item li.compose:hover {
            background: transparent;
        }

        /* Mail List Container */

        .notification-wrapper .notification-list-container {
            border-left: 1px solid #e9e9e9;
            height: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        .notification-wrapper .notification-list-container a{
            text-decoration: none;
        }

        .notification-wrapper .notification-list-container .tab-content .tab-pane .nav .nav-item {
            padding-right: 1px;
            padding-bottom: 1px;
            padding-left: 1px;
        }

        .notification-wrapper .notification-list-container .tab-content .tab-pane .nav .nav-item a .sender-name {
            font-size: 0.75rem;
            font-weight: 400;
            max-width: 95%;
        }

        .notification-wrapper .notification-list-container .tab-content .tab-pane .nav .nav-item a{
            margin: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: black;
        }

        /* Message Content */
        .notification-wrapper .notification-body .sender-details {
            padding: 20px 15px 0;
            border-bottom: 1px solid #e9e9e9;
            display: -webkit-flex;
            display: flex;
        }

        .notification-wrapper .notification-body .sender-details .details {
            padding-bottom: 0;
        }

        .notification-wrapper .notification-body .sender-details .details .msg-subject {
            font-weight: 600;
        }

        .notification-wrapper .notification-body .sender-details .details .sender-email {
            margin-bottom: 20px;
            font-weight: 400;
        }

        .notification-wrapper .notification-body .sender-details .details .sender-email i {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 1px 0 7px;
        }

        .notification-wrapper .notification-body .message-content {
            padding: 50px 15px;
        }

        p {
            color: black;
        }

    </style>

    <link rel="stylesheet" href="/css/inbox.css">


    <div class="container-fluid">
        <div class="content">
            <div class="notification-wrapper wrapper">
                <div class="row align-items-stretch">
                    <!--nav-->
                    <div class="sidebar d-none d-lg-block col-md-2 pt-3  bg-white">
                        <ul class="nav nav-tabs" id="navTabPrimary" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab"
                                   aria-controls="inbox" aria-selected="true"><i class="fa fa-envelope"></i> Boîte de
                                    réception</a>
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
                            <div class="tab-pane fade show active" id="inbox" role="tabpanel"
                                 aria-labelledby="inbox-tab">

                                <ul class="nav nav-tabs flex-column" id="navTabSecondary" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="welcome-tab" data-toggle="tab" href="#welcome"
                                           role="tab" aria-controls="welcome" aria-selected="true">
                                            <p class="sender-name">Système</p> Bienvenue
                                        </a>
                                    </li>
                                    @php $id = 0 @endphp
                                    @foreach($inboxes as $inbox)
                                        @if($inbox->notification->trash == 0)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="id{{$id}}-tab" data-toggle="tab"
                                                   href="#id{{$id}}" role="tab" aria-controls="id{{$id}}"
                                                   aria-selected="true">
                                                    <p class="sender-name">Système</p> {{ $inbox->notification->title }}
                                                </a>
                                            </li>
                                        @endif
                                        @php $id++ @endphp
                                    @endforeach
                                </ul>
                            </div>

                            <!--Nav TRASH-->
                            <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">

                                <ul class="nav nav-tabs flex-column" id="navTabSecondary" role="tablist">
                                    @php $id = 0 @endphp
                                    @foreach($inboxes as $inbox)
                                        @if($inbox->notification->trash == 1)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="id{{$id}}-tab" data-toggle="tab"
                                                   href="#id{{$id}}" role="tab" aria-controls="id{{$id}}"
                                                   aria-selected="true">
                                                    <p class="sender-name">Système</p> {{ $inbox->notification->title }}
                                                </a>
                                            </li>
                                        @endif
                                        @php $id++ @endphp
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                    <!--Body notification-->
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
                                        <p>Bonjour, merci à vous de nous avoir rejoins</p>
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
                                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('inbox.toTrash', $inbox->notification->id) }}">
                                                    <i class="fa fa-trash text-primary mr-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-2 mb-4 mt-4">
                                                <div class="btn-toolbar">
                                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('notification.destroy', $inbox->notification->id) }}">
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
