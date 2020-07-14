@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                <form method="post" action="{{ route('page.store') }}" class="comment-form contact-form" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="title">Titre de la page</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titre de la page">
                        </div>
                        <div class="form-group">
                            <label for="description">Description de la page</label>
                            <textarea type="textarea" class="form-control" id="description" name="description" placeholder="Description de la page"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image"/>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Créer la page</button>
                </form>
            </div>
        </div>
    </div>

@stop
