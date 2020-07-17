@extends('layouts.app')


@section('content')

    <div class="container">
        <div class=" text-center">
            <h1>Liste de mes collections :</h1>
        </div>
        <div class="text-center">
            <input class="form-control" id="myInput" type="text" placeholder="Rechercher une collection..">
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
                                    @if($collection->image === 'default_collection.jpg')
                                    <img src="/storage/default/{{ $collection->image }}" height="150px">
                                    @else
                                        <img src="/storage/collections/{{ Auth::user()->id  }}/{{ $collection->image }}" height="150px">
                                    @endif
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
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".col-md-4").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@stop
