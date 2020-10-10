@extends('layouts.app')


@section('content')

    <div class="container" style="padding-top: 150px">
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                <form method="post" action="{{ route('collection.store') }}" class="comment-form contact-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" style="color: white">Nom de la collection</label>
                        <input type="text" class="form-control" id="title" name="name"
                               placeholder="Nom de la collection" required>
                    </div>
                    <div class="form-group">
                        <label for="description" style="color: white">Description de la collection</label>
                        <textarea type="textarea" class="form-control" id="description" name="description"
                                  placeholder="Description de la collection" required></textarea>
                    </div>
                    <div class="form-group float-left">
                        <input type="file" id="monInputFile" name="image" style="visibility:hidden"/>
                        <input value="Sélectionner un fichier" type="button"
                               class="btn btn-success" style="float: left"
                               onclick="$('#monInputFile').click();"/>
                    </div>
                    <br><br><br>
                    <div style="float: right;">
                        <button type="submit"  class="btn btn-primary"><i
                                class="fa fa-check" aria-hidden="true"></i>
                            Créer la collection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

