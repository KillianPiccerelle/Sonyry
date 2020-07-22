@extends('layouts.app')

@section('content')



    <div id="carouselExemple" class="carousel slide" data-ride="carousel" data-interval="5000">

        <ol class="carousel-indicators">
            <li data-target="#carouselExemple" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExemple" data-slide-to="1"></li>
            <li data-target="#carouselExemple" data-slide-to="2"></li>
        </ol>


        <div class="carousel-inner">

            <div class="carousel-item active">
                <img
                    src="https://images.unsplash.com/photo-1516414447565-b14be0adf13e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1266&q=80"
                    class="d-block">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Créez</h1>
                    <p>Créez votre portefolio.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                    class="d-block">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Collaborez</h1>
                    <p>Collaborez avec vos pairs sur des projets.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img
                    src="https://images.unsplash.com/photo-1585909694668-0a6e0ddbfe8b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                    class="d-block">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Partagez</h1>
                    <p>Partagez vos créations.</p>
                </div>
            </div>

        </div>

        <a href="#carouselExemple" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#carouselExemple" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>


    <script>
        $('.carousel').carousel({

            pause: "null"

        })
    </script>

@endsection
