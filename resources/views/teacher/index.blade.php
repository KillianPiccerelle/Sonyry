@extends('layouts.app')


@section('content')

    <div></div>
    <h1 style="color: white; text-align: center ">Liste des étudiants</h1>

    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.teacher.navbar')
        </div>


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
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->name }}</th>
                        <th scope="row">{{ $user->firstName }}</th>
                        <th scope="row"><a href="#" class="btn btn-primary">Consulter</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
