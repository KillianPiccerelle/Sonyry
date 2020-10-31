@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="ml-3 w-75">
            <h1>Documents partagés avec le groupe</h1>
            <hr>

            @livewire('shares',['id' => $group->id])

        </div>
    </div>


@stop
