@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                <form method="post" action="{{ route('collection.store') }}" class="comment-form contact-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Nom de la collection</label>
                        <input type="text" class="form-control" id="title" name="name" placeholder="Nom de la collection">
                    </div>
                    <div class="form-group">
                        <label for="description">Description de la collection</label>
                        <textarea type="textarea" class="form-control" id="description" name="description" placeholder="Description de la collection"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="image"/>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Créer la collection</button>
                </form>
            </div>
        </div>
    </div>

@stop

