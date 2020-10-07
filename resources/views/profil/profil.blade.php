@extends('layouts.app')


@section('content')

    <style>
        p {
            text-align: center;
            font-size: 110%;
        }

        form {
            /* Uniquement centrer le formulaire sur la page */
            margin: 0 auto;
            width: 1000px;
            /* Encadré pour voir les limites du formulaire */
            padding: 2em;
            border: 2px solid #E74C3C;
            border-radius: 2em;
        }

        label {
            display: block;
            width: 150px;
            float: left;
        }

        input {

            font-weight: bold;
        }

    </style>

    <link rel="stylesheet" href="/css/profil.css"></link>

    <!------ Include the above in your HEAD tag ---------->

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 ml-lg-5 mr-lg-5" style="width: 100%">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="info" onclick="ajax('{{ route('profil.info') }}')">Informations personnelles</a>
                        <a class="nav-item nav-link" id="contact" onclick="ajax('{{ route('profil.contact') }}')">Mes contacts</a>
                        <a class="nav-item nav-link" id="portfolio" onclick="ajax('{{ route('profil.portfolio') }}')">Mes portfolios</a>
                        <a class="nav-item nav-link" id="group" onclick="ajax('{{ route('profil.group') }}')">Mes groupes</a>
                        <a class="nav-item nav-link" id="edit" onclick="ajax('{{ route('profil.edit') }}')">Editer votre profil</a>
                    </div>
                </nav>

                <div id="content"></div>
            </div>
        </div>

        <script>
            $(window).on("load",function () {
                $.ajax({
                    type:'GET',
                    url:"{{ route('profil.info') }}",
                    success:function(data){
                        document.getElementById("content").innerHTML = data;
                    }
                });
            });

            function ajax(route) {
                $.ajax({
                    type:'GET',
                    url:route,
                    success:function(data){
                        document.getElementById("content").innerHTML = data;
                    }
                });
            }

            function ajaxUpdate() {

                form = ($('#profilForm').serializeArray());

                console.log($("#username"))
                $.ajax({
                    type:'PUT',
                    data: form,
                    url:"{{route('profil.update')}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        document.getElementById("content").innerHTML = data;



                    }
                });
            }
        </script>

@endsection
