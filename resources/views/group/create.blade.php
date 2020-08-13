@extends('layouts.app')


@section('content')

    <div class="container">
        <x-forms.form route="group.store">
            <x-forms.text name="name" label="Saisissez le nom du groupe que vous voulez créer">

            </x-forms.text>
        </x-forms.form>
    </div>

@endsection
