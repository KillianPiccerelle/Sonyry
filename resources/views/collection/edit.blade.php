@extends('layouts.app')


@section('content')

<div class="container text-center">
    <div class="text-center">
        <h5>Titre de la collection : <b>{{ $collection->name }}</b></h5>
    </div>
    <div>
        <p>Description :</p>
        <p>{{ $collection->description }}</p>
    </div>
    <br>
    <hr>

@stop
