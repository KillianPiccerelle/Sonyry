@extends('layouts.app')
@section('content')

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
                    <livewire:body-notification />
                </div>
            </div>
        </div>
    </div>
@endsection
