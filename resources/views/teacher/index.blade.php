@extends('layouts.app')


@section('content')

    <div></div>
    <h1 style="color: white; text-align: center ">Liste des étudiants</h1>

    <div class="row">
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Pages</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <th scope="row" style="color: #ffffff">{{ $user->user->name }}</th>
                        <th scope="row" style="color: #ffffff">{{ $user->user->firstName }}</th>
                        <th scope="row"><a href="{{route('teacher.viewPages', $user->id)}}" class="btn btn-primary">Consulter</a></th>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
