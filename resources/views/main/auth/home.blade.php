@extends('layouts.app')

@section('content')

    @php
        $limite =7;
    @endphp

    <style>
        .flex {
            margin: 50px;
            display: flex;
            justify-content: space-between;
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


    </style>

    <div>
        <h1 style="text-align: center; ; font-weight: bold;font-family: Courier New;">
            <p id="typewriter" class="typewrite" style="color: azure" data-period="2000"
               data-type='[ "Bienvenue sur Sonyry {{ Auth::User()->firstName }}." ]'>
                <span class="wrap"></span>
            </p>
        </h1>
    </div>

    <div class="flex">

        <div class="flex1">
            <div class="card card-default" style="max-width: 100%">
                <!--card header-->
                <div class="card-header">
                    <h5 class="card-title">
                        Mon portfolio
                    </h5>
                </div>
                <!--card body-->

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="collection-tab" data-toggle="tab"
                           href="#rubriquesPortfolio" role="tab" aria-controls="rubriques"
                           aria-selected="true">Rubriques</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="page-tab" data-toggle="tab"
                           href="#pagePortfolio" role="tab" aria-controls="page"
                           aria-selected="true">Pages</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="rubriquesPortfolio" role="tabpanel"
                         aria-labelledby="collection-tab">
                        @if(count(Auth::user()->collections) > 0)
                            @php
                                $collections = Auth::user()->collections;
                            @endphp
                            @for($i = 0; $i < $limite; $i++)
                                @if(isset($collections[$i]))
                                    <div class="list-group">
                                        <div class="post">
                                            <a href="{{ route('collection.edit', $collections[$i]->id) }}"
                                               class="list-group-item list-group-item-action">{{ $collections[$i]->name }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        @else
                            <p>Aucun élément modifié dernièrement.</p>
                        @endif
                    </div>
                    <div class="tab-pane fade show active" id="pagePortfolio" role="tabpanel"
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
                                               class="list-group-item list-group-item-action">{{ $pages[$i]->title }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        @else
                            <p>Aucun élément modifié dernièrement.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex1">
            <div class="card card-default" style="max-width: 70%">
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
                </div>
            </div>
        </div>


    </div>

    <script>
        var TxtType = function (el, toRotate, period) {
            this.toRotate = toRotate;
            this.el = el;
            this.loopNum = 0;
            this.period = parseInt(period, 10) || 2000;
            this.txt = '';
            this.tick();
            this.isDeleting = false;
        };

        TxtType.prototype.tick = function () {
            var i = this.loopNum % this.toRotate.length;
            var fullTxt = this.toRotate[i];

            if (this.isDeleting == false) {
                this.txt = fullTxt.substring(0, this.txt.length + 1);
            }

            this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

            var that = this;
            var delta = 200 - Math.random() * 100;

            if (!this.isDeleting && this.txt != fullTxt) {
                setTimeout(function () {
                    that.tick();
                }, delta);
            } else {
                document.getElementById("typewriter").className = "";
            }
        };

        window.onload = function () {
            var elements = document.getElementsByClassName('typewrite');
            for (var i = 0; i < elements.length; i++) {
                var toRotate = elements[i].getAttribute('data-type');
                var period = elements[i].getAttribute('data-period');
                if (toRotate) {
                    new TxtType(elements[i], JSON.parse(toRotate), period);
                }
            }
            // INJECT CSS
            var css = document.createElement("style");
            css.type = "text/css";
            css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
            document.body.appendChild(css);
        };
    </script>
@endsection
