@extends('layouts.app')


@section('content')

    <div class="container">
        @if(count($groups) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom du groupe</th>
                    <th scope="col">Nombre de personnes dans le groupe</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->group->name }}</td>
                        <td>{{ $group->members }}</td>
                        <td>
                            <a href="{{ route('group.show', $group->group->id) }}" class="btn btn-primary">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h5 class="text-center">Vous n'appartenez actuellement à aucun groupe. Pour en créer un cliquez sur le bouton ci-dessous :</h5>
            <br>
            <div class="text-center">
                <a href="{{ route('group.create') }}" class="btn btn-outline-dark text-center">Créer un groupe</a>
            </div>
        @endif
    </div>
@endsection
