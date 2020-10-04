@extends('layouts.app')

@section('content')

    @php

        $firstname = Auth::user()->firstName;
        $firstname = ($firstname);

        $nbChar = strlen($firstname );

    @endphp

    <style>
        .flex {
            margin: 50px;
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            flex-wrap: nowrap;

        }

        .flex .flex1 {

            height: auto;
            width: 30%;
        }

        #nav-sujet-tab {
            background-color: darkorange;
            color: black;
        }

        #nav-sujet-tab:hover {
            background-color: #ffffff;
        }

        #nav-page-tab {
            background-color: darkorange;
            color: black;
        }

        #nav-page-tab:hover {
            background-color: #ffffff;
        }

        #nav-collection-tab {
            color: black;
            background-color: darkorange;
        }

        #nav-collection-tab:hover {
            background-color: #ffffff;
        }


        #logo {
            position: absolute;

            left: 50%;
            transform: translate(-60%, -110%);
            animation: fill 0.5s ease forwards 3.5s;
        }

        @for($i = 0; $i < $nbChar; $i++)
                #logo path:nth-child({{ $i+1 }}) {
            stroke-dasharray: 246;
            stroke-dashoffset: 246;
            animation: line-anim 2s ease forwards;
        }

        @endfor



 @keyframes line-anim {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fill {
            from {
                fill: transparent;
            }
            to {
                fill: white;
            }
        }

    </style>

    <div>
        <h1 style="color: white;left: 30%; position: relative;">Bienvenue </h1>
        <svg
            id="logo"
            width="auto"
            height="56"
            viewBox="0 0 278 56"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">

            @for($i = 0; $i < $nbChar; $i++)

                @include('components.svg.'.$firstname[$i])

            @endfor


        </svg>


    </div>









    <hr style="display: block;  border-top: 1px solid #ddd;  width: 90%;  margin:auto; ">


    <div class="flex">
        <div class="flex1">
            <div class="card card-default" style="max-width: 75%">
                <!--card header-->
                <div class="card-header">
                    <h5 class="card-title">
                        Modifications récentes
                    </h5>
                </div>
                <!--card body-->

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
                            @foreach(Auth::user()->pages as $page)
                                <div class="list-group">
                                    <div class="post">
                                        <a href="{{ route('page.edit', $page->id) }}"
                                           class="list-group-item list-group-item-action">{{ $page->title }}
                                            édité le {{ $page->updated_at }}</a>
                                    </div>
                                </div>
                            @endforeach
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


        <div class="flex1">
            <div class="card card-default" style="max-width: 75%">
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
                           href="#pagePortfolios" role="tab" aria-controls="page"
                           aria-selected="true">Page</a>
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


        <div class="flex1">


            <div class="col-xs-12" style="width: 75%">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-sujet-tab" data-toggle="tab"
                           href="#nav-sujet"
                           role="tab" aria-controls="nav-sujet" aria-selected="true">Sujets</a>
                        <a class="nav-item nav-link" id="nav-page-tab" data-toggle="tab"
                           href="#nav-page"
                           role="tab" aria-controls="nav-page" aria-selected="false">Pages</a>
                        <a class="nav-item nav-link" id="nav-collection-tab" data-toggle="tab"
                           href="#nav-collection"
                           role="tab" aria-controls="nav-collection">Collections
                        </a>
                    </div>
                </nav>

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-sujet" role="tabpanel"
                         aria-labelledby="nav-sujet-tab">
                        <!--Sujets que je suis-->
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
                                            <a href="#"
                                               class="list-group-item list-group-item-action">voilà
                                                1</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-page" role="tabpanel"
                         aria-labelledby="nav-page-tab">
                        <!--Pages suivies-->

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
                                            <a href="#"
                                               class="list-group-item list-group-item-action">voilà
                                                1</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-collection" role="tabpanel"
                         aria-labelledby="nav-collection-tab">
                        <!--Collections suivies-->
                        <div class="row row-cols-2">
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
                                            <a href="#"
                                               class="list-group-item list-group-item-action">voilà
                                                1</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>








    <script>
        const logo = document.querySelectorAll("#logo path");

        for (let i = 0; i < logo.length; i++) {
            console.log(`Letter ${i} is ${logo[i].getTotalLength()}`);
        }
    </script>







@endsection
