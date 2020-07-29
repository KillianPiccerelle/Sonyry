@extends('layouts.app')


@section('content')

    <div class="container">
        <x-bootstrap.alert-danger>
            Le texte de mon alerte
        </x-bootstrap.alert-danger>
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                <x-bootstrap.card>
                    <x-forms.form route="page.store">
                        <x-forms.date></x-forms.date>
                        <x-forms.text name="titre" value="" label="Titre" placeholder="Titre de la page"></x-forms.text>
                        <x-forms.select label="Type de page" name="type" :items="App\User::all()" value="2"></x-forms.select>
                            <div class="form-group">
                                <label for="description">Description de la page</label>
                                <textarea type="textarea" class="form-control" id="description" name="description" placeholder="Description de la page"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                    </x-forms.form>
                </x-bootstrap.card>
            </div>
        </div>
    </div>

@stop
