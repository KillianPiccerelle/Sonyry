@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="card-header text-center">
            <h1>Liste de mes collections :</h1>
        </div>
        <br>
        <div class="row">
            @if(count($collections) > 0)
                @foreach($collections as $collection)
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header">
                                <h5><span>{{ $collection->name }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div>

                                </div>
                                <br>
                                <div class="text-center">

                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @else
                <p>Pas de collections.</p>
            @endif
        </div>
    </div>

@stop
