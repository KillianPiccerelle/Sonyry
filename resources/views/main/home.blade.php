@extends('layouts.app')

@section('content')
    <div class="container col-10">
        <div class="row">
            <div class="col-lg-9 main">
                <div>
                    <h1>Bienvenue</h1>
                    <p></p>
                    <hr style="size: 10px">
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Modifications récentes
                                    </h5>
                                </div>
                                <!--card body-->
                                <div class="list-group">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="page-tab" data-toggle="tab" href="#page" role="tab" aria-controls="page" aria-selected="true">Page</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="Collection-tab" data-toggle="tab" href="#collection" role="tab" aria-controls="Collection" aria-selected="false">Collection</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="page" role="tabpanel" aria-labelledby="page-tab">
                                            @if(count(Auth::user()->pages) > 0)
                                                @foreach(Auth::user()->pages as $page)
                                                    <div class="list-group">
                                                        <div class="post">
                                                            <a href="" class="list-group-item list-group-item-action">{{ $page->title }} édité le {{ $page->updated_at }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Aucun élément modifié dernièrement.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="collection" role="tabpanel" aria-labelledby="collection-tab">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Boîte de réception
                                    </h5>
                                </div>
                                <!--card body-->
                                <div class="list-group">
                                    <div class="post">
                                        <a href="#" class="list-group-item list-group-item-action">voilà 1</a>
                                    </div>
                                    <div class="post">
                                        <a href="#" class="list-group-item list-group-item-action">voilà 2</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 15px"></div>
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Mes portfolios
                                    </h5>
                                </div>
                                <!--card body-->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="page-tab" data-toggle="tab" href="#page" role="tab" aria-controls="page" aria-selected="true">Page</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="Collection-tab" data-toggle="tab" href="#collection" role="tab" aria-controls="Collection" aria-selected="false">Collection</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="page" role="tabpanel" aria-labelledby="page-tab">
                                        @if(count(Auth::user()->pages) > 0)
                                            @foreach(Auth::user()->pages as $page)
                                                <div class="list-group">
                                                    <div class="post">
                                                        <a href="" class="list-group-item list-group-item-action">{{ $page->title }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Aucun élément modifié dernièrement.</p>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="collection" role="tabpanel" aria-labelledby="collection-tab">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Sujets que je suis
                                    </h5>
                                </div>
                                <!--card body-->
                                <div class="list-group">
                                    <div class="post">
                                        <a href="#" class="list-group-item list-group-item-action">voilà 1</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 15px"></div>
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Pages suivies
                                    </h5>
                                </div>
                                <!--card body-->
                                <div class="list-group">
                                    <div class="post">
                                        <a href="#" class="list-group-item list-group-item-action">voilà 1</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-default">
                                <!--card header-->
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Collections suivies
                                    </h5>
                                </div>
                                <!--card body-->
                                <div class="list-group">
                                    <div class="post">
                                        <a href="#" class="list-group-item list-group-item-action">voilà 1</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 sidebar">
                <div class="sideblock-2">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">
                                Utilisateurs en ligne
                            </h4>
                            <p class="" style="font-size: smaller">(10 dernières minutes)</p>
                        </div>
                        <div class="list-group">
                            <div class="post">
                                <a href="#" class="list-group-item list-group-item-action">Utilisateur 1</a>
                            </div>
                            <div class="post">
                                <a href="#" class="list-group-item list-group-item-action">Utilisateur 2</a>
                            </div>
                            <div class="post">
                                <a href="#" class="list-group-item list-group-item-action">Utilisateur 3</a>
                            </div>
                            <div class="post">
                                <a href="#" class="list-group-item list-group-item-action">Utilisateur 4</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
