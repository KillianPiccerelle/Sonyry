@extends('layouts.app')


@section('content')

    <div class="container" style="padding-top: 150px">
        <div class="d-flex justify-content-center">
            <div class="col-lg-8">
                <form method="post" action="{{ route('page.store') }}" class="comment-form contact-form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Nom de la page</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="Nom de la page" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description de la page</label>
                        <textarea type="textarea" class="form-control" id="description" name="description"
                                  placeholder="Description de la page" required></textarea>
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
                            Créer la page
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop

