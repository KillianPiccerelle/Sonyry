@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-sm-1 border-right">
            @include('incs.auth.group.navbar')
        </div>
        <div class="ml-3 w-75">
            <h1>Documents partagés avec le groupe</h1>
            <hr>
            <div class="container-fluid">
                <button class="btn btn-light text-left h-100 container-fluid" type="button" data-toggle="collapse" data-target="#collapseExample">
                    Issou
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
