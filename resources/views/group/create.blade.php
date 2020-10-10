@extends('layouts.app')


@section('content')

    <style>
        label {
            color: white;
        }
    </style>
    <div class="container" style="padding-top: 150px">
        <x-forms.form route="group.store">
            <x-forms.text name="name" label="Saisissez le nom du groupe que vous voulez créer" required>

            </x-forms.text>
            <div style="float: right;">
                <button type="submit"  class="btn btn-primary"><i
                        class="fa fa-check" aria-hidden="true" ></i>
                    Créer le groupe
                </button>
            </div>
        </x-forms.form>
    </div>

@endsection
