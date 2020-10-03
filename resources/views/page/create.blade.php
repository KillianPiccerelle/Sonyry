@extends('layouts.app')


@section('content')

    <div class="container" style="padding-top: 150px">
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                    <x-forms.form route="page.store">
                        <x-forms.text name="title" value="" label="Titre" placeholder="Titre de la page"></x-forms.text>
                            <div class="form-group">
                                <label for="description">Description de la page</label>
                                <textarea type="textarea" class="form-control" id="description" name="description" placeholder="Description de la page"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                    </x-forms.form>
            </div>
        </div>
    </div>

@stop
