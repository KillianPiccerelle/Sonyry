@extends('layouts.app')


@section('content')

    <div class="container">
        @if(count($groups) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th  style="color: white" scope="col">Nom du groupe</th>
                    <th  style="color: white"scope="col">Nombre de personnes dans le groupe</th>
                    <th  style="color: white" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td  style="color: white">{{ $group->group->name }}</td>
                        <td  style="color: white">{{ $group->members }}</td>
                        <td>
                            <a href="{{ route('group.show', $group->group->id) }}" class="btn btn-primary">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h5 class="text-center" style="color: white; padding-top: 200px">Vous n'appartenez actuellement à aucun groupe. Pour en créer un cliquez sur le bouton ci-dessous :</h5>
            <br>
            <div class="text-center">
                <a href="{{ route('group.create') }}" class="btn btn-primary text-center" >Créer un groupe</a>
            </div>
        @endif
    </div>
@endsection
