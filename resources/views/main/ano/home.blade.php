@extends('layouts.app')

@section('content')



    <div id="option" class="carousel slide  carousel-fade" data-pause="hover" data-interval="3000">

        <ol class="carousel-indicators">
            <li data-target="#option" data-slide-to="0" class=""></li>
            <li data-target="#option" data-slide-to="1"></li>
            <li data-target="#option" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="/img/carousel1.jpg"
                     class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Créez</h1>
                    <p>Créez votre portefolio.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="/img/carousel2.jpg"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Collaborez</h1>
                    <p>Collaborez avec vos pairs sur des projets.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="/img/carousel3.jpg"
                    class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Partagez</h1>
                    <p>Partagez vos créations.</p>
                </div>
            </div>

        </div>

        <a href="#option" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#option" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>


    </div><br>

    <footer id="sticky-footer" class="py-1  pb-0.5 bg-theme"><div class="container text-center"><small style="color: white; padding-bottom: -0.5rem">Copyright 2020 © Sonyry</small></div></footer>


    <script>

    </script>

@endsection
