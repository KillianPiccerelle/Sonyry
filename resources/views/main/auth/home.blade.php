@extends('layouts.app')

@section('content')
    @php
    $limite = 10;
    @endphp

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
                                            <a class="nav-link active" id="page-tab" data-toggle="tab" href="#pageModif"
                                               role="tab" aria-controls="page" aria-selected="true">Page</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="collection-tab" data-toggle="tab"
                                               href="#collectionModif" role="tab" aria-controls="collection"
                                               aria-selected="true">Collection</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="pageModif" role="tabpanel"
                                             aria-labelledby="page-tab">
                                            @if(count(Auth::user()->pages) > 0)
                                                @php
                                                    $pages  = Auth::user()->pages
                                                @endphp
                                                @for($i = 0; $i < $limite; $i++)
                                                    @if(isset($pages[$i]))
                                                        <div class="list-group">
                                                            <div class="post">
                                                                <a href="{{ route('page.edit', $pages[$i]->id) }}"
                                                                   class="list-group-item list-group-item-action">{{ $pages[$i]->title }}
                                                                    édité le {{ $pages[$i]->updated_at }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endfor
                                            @else
                                                <p>Aucun élément modifié dernièrement.</p>
                                            @endif
                                        </div>
                                        <div class="tab-pane fade" id="collectionModif" role="tabpanel"
                                             aria-labelledby="collection-tab">
                                            @if(count(Auth::user()->collections) > 0)
                                                @foreach(Auth::user()->collections as $collection)
                                                    <div class="list-group">
                                                        <div class="post">
                                                            <a href="{{ route('collection.edit', $collection->id) }}"
                                                               class="list-group-item list-group-item-action">{{ $collection->name }}
                                                                édité le {{ $collection->updated_at }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Aucun élément modifié dernièrement.</p>
                                            @endif
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
                                        Mes portfolios
                                    </h5>
                                </div>
                                <!--card body-->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="page-tab" data-toggle="tab"
                                           href="#pagePortfolios" role="tab" aria-controls="page" aria-selected="true">Page</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="collection-tab" data-toggle="tab"
                                           href="#collectionPortfolios" role="tab" aria-controls="collection"
                                           aria-selected="true">Collection</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pagePortfolios" role="tabpanel"
                                         aria-labelledby="page-tab">
                                        @if(count(Auth::user()->pages) > 0)
                                            @foreach(Auth::user()->pages as $page)
                                                <div class="list-group">
                                                    <div class="post">
                                                        <a href="{{ route('page.edit', $page->id) }}"
                                                           class="list-group-item list-group-item-action">{{ $page->title }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Aucun élément modifié dernièrement.</p>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="collectionPortfolios" role="tabpanel"
                                         aria-labelledby="collection-tab">
                                        @if(count(Auth::user()->collections) > 0)
                                            @foreach(Auth::user()->collections as $collection)
                                                <div class="list-group">
                                                    <div class="post">
                                                        <a href="{{ route('collection.edit', $collection->id) }}"
                                                           class="list-group-item list-group-item-action">{{ $collection->name }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Aucun élément modifié dernièrement.</p>
                                        @endif
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
                    </div>
                    <div style="height: 15px"></div>
                    <div class="row row-cols-2">
                        <div class="col-6">
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
