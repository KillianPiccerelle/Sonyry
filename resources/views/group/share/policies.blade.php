@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="ml-3 w-75">
            <h1>Autorisations de la page {{ $page->title }}</h1>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($members as $member)
                                @if($member->user->id !== Auth::user()->id)
                                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#{{ $member->user->name.$member->user->id }}" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ $member->user->name }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <div class="container-fluid">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach($members as $member)
                                    @if($member->user->id !== Auth::user()->id)
                                        <div class="tab-pane fade" id="{{ $member->user->name.$member->user->id }}" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <h5>Autorisations de {{ $member->user->name }}</h5>
                                            <br>
                                            <form method="post" action="{{ route('policies.store',['id'=>$group->id,'page'=>$page, 'member'=>$member->user]) }}" class="comment-form contact-form" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="" name="read"
                                                        @if(count($member->policy) > 0)
                                                            @if($member->policy[0]->read === 1)
                                                                checked
                                                            @endif
                                                        @endif
                                                    >
                                                    <label class="form-check-label" for="">
                                                        Consulter la page
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="" name="write"
                                                           @if(count($member->policy) > 0)
                                                            @if($member->policy[0]->write === 1)
                                                           checked
                                                        @endif
                                                        @endif
                                                    >
                                                    <label class="form-check-label" for="">
                                                        Editer la page
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" id="" name="execute"
                                                           @if(count($member->policy) > 0)
                                                           @if($member->policy[0]->execute === 1)
                                                           checked
                                                        @endif
                                                        @endif
                                                    >
                                                    <label class="form-check-label" for="">
                                                        Supprimer la page
                                                    </label>
                                                </div>
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="valider">
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@stop
