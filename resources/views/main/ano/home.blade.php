@extends('layouts.app')

@section('content')

    <link href="/css/carousel.css" rel="stylesheet">

    <div class="background"></div>

    <div style="margin-top: 120px;" id="carouselExemple" class="carousel slide" data-ride="carousel" data-interval="3500">

        <ol class="carousel-indicators">
            <li data-target="#carouselExemple" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExemple" data-slide-to="1"></li>
            <li data-target="#carouselExemple" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">

            <div class="carousel-item active">
                <img
                    src="/img/carou2.jpg"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Créez</h1>
                    <p>Créez votre portefolio.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="/img/carou1.jpg"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Collaborez</h1>
                    <p>Collaborez avec vos pairs sur des projets.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="/img/carou3.jpg"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Partagez</h1>
                    <p>Partagez vos créations.</p>
                </div>
            </div>

        </div>

        <a   class="carousel-control-prev" href="#carouselExemple" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a  class="carousel-control-next" href="#carouselExemple" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>


    </div>


    <script>
        $('.carousel').carousel({

            pause: "null"

        })
    </script>

@endsection
