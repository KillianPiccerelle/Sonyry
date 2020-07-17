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
                                <br>
                                <div class="post mt-3">
                                    <p style="margin-left: 20px">voilà 1</p>
                                </div>
                                <hr style="size: 5px">
                                <div class="post">
                                    <p style="margin-left: 20px">voilà 2</p>
                                </div>
                                <hr style="size: 5px">
                                <div class="post">
                                    <p style="margin-left: 20px">voilà 3</p>
                                </div>
                                <hr style="size: 5px">
                                <div class="post">
                                    <p style="margin-left: 20px">voilà 3</p>
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
                                <br>
                                <div class="post mt-3">
                                    <p style="margin-left: 20px">voilà 1</p>
                                </div>
                                <hr style="size: 5px">
                                <div class="post">
                                    <p style="margin-left: 20px">voilà 2</p>
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
                                <p style="margin-left: 20px">voilà</p>
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
                                <p style="margin-left: 20px">voilà</p>
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
                                <p style="margin-left: 20px">voilà</p>
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
                                <p style="margin-left: 20px">voilà</p>
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
                        <br>
                        <div class="post mt-3">
                            <p style="margin-left: 20px">Utilisateur 1</p>
                        </div>
                        <hr style="size: 5px">
                        <div class="post">
                            <p style="margin-left: 20px">Utilisateur 2</p>
                        </div>
                        <hr style="size: 5px">
                        <div class="post">
                            <p style="margin-left: 20px">Utilisateur 3</p>
                        </div>
                        <hr style="size: 5px">
                        <div class="post">
                            <p style="margin-left: 20px">Utilisateur 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
