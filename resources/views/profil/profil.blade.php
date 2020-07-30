@extends('layouts.app')


@section('content')


    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-xs-12 ">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informations personnelles</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Mes contacts</a>
                        <a class="nav-item nav-link" id="nav-portfolios-tab" data-toggle="tab" href="#nav-portfolios" role="tab" aria-controls="nav-portfolios" aria-selected="false">Mes portfolios</a>
                        <a class="nav-item nav-link" id="nav-groupes-tab" data-toggle="tab" href="#nav-groupes" role="tab" aria-controls="nav-groupes" aria-selected="false">Mes groupes</a>
                        <a class="nav-item nav-link" id="nav-Edit-tab" data-toggle="tab" href="#nav-Edit" role="tab" aria-controls="nav-Edit" aria-selected="false">Editer votre profil</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form method="post" action="#">

                            @php
                            $user = Auth::user();
                                @endphp

                            Nom : {{ $user->name }}<br>
                            Prénom : {{ $user->firstName }}<br>
                            Email : {{ $user->email }}<br>
                            Emploi : {{ $user->job }}<br>
                            Secteur d'activité : {{ $user->businessSegment }}<br>
                            Rue : {{ $user->streetAddress }}<br>
                            Ville : {{ $user->cityAddress }}<br>
                            Code Postal : {{ $user->postCodeAddress }}<br>
                            Pays : {{ $user->country }}<br>
                            Téléphone portable : {{ $user->mobilePhone }}<br>
                            Téléphone de travail : {{ $user->businessPhone }}<br>
                            Description : {{ $user->description }}<br>

                        </form>
                    </div>



                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        2
                    </div>


                    <div class="tab-pane fade" id="nav-portfolios" role="tabpanel" aria-labelledby="nav-portfolios-tab">

                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-pages-tab" data-toggle="tab" href="#nav-pages" role="tab" aria-controls="nav-pages" aria-selected="true">Pages</a>
                                <a class="nav-item nav-link" id="nav-collections-tab" data-toggle="tab" href="#nav-collections" role="tab" aria-controls="nav-collections" aria-selected="false">Collections</a>
                            </div>
                        </nav>


                            <div class="tab-pane fade show active" id="nav-pages" role="tabpanel" aria-labelledby="nav-pages-tab">

                            </div>


                            <div class="tab-pane fade show active" id="nav-collections" role="tabpanel" aria-labelledby="nav-collections-tab">

                            </div>

                    </div>


                    <div class="tab-pane fade" id="nav-groupes" role="tabpanel" aria-labelledby="nav-groupes-tab">
                        4
                    </div>




                    <div class="tab-pane fade" id="nav-Edit" role="tabpanel" aria-labelledby="nav-Edit-tab">


                        <form method="POST" action="{{route('profil.update',$user->id)}}">

                            <label for="newName">Nom</label>
                            <input type="text" name="newName" placeholder="{{ $user->name }}"><br>

                            <label for="newFirstname">Prénom</label>
                            <input type="text" name="newFirstname" placeholder="{{ $user->firstName }}"><br>

                            <label for="newEmail">Email</label>
                            <input type="email" id="inputEmail"  @error('email') is-invalid @enderror"  name="newEmail" placeholder="{{ $user->email }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br>

                            <label for="newJob">Emploi</label>
                            <input type="text" name="newJob" placeholder="{{ $user->job }}"><br>

                            <label for="newJobSegment">Secteur d'activité</label>
                            <input type="text" name="newJobSegment" placeholder="{{ $user->businessSegment }}"><br>

                            <label for="newStreet">Rue</label>
                            <input type="text" name="newStreet" placeholder="{{ $user->streetAddress }}"><br>

                            <label for="newCity">Ville</label>
                            <input type="text" name="newCity" placeholder="{{ $user->cityAddress }}"><br>

                            <label for="newPostalCode">Code Postal</label>
                            <input type="text" name="newPostalCode" placeholder="{{ $user->postCodeAddress }}"><br>

                            <label for="newCountry">Pays</label>
                            <input type="text" name="newCountry" placeholder="{{ $user->country }}"><br>

                            <label for="newMobilePhone">Téléphone portable</label>
                            <input type="text" name="newMobilePhone" placeholder="{{ $user->mobilePhone }}"><br>

                            <label for="newWorkPhone">Téléphone de travail</label>
                            <input type="text" name="newWorkPhone" placeholder="{{ $user->businessPhone }}"><br>

                            <label for="newDescription">Description</label>
                            <input type="text" name="newDescription" placeholder="{{ $user->description }}"><br>


                            <input type="submit" name="submit" value="Mettre à jour mon profil">
                        </form>


                    </div>

                </div>

            </div>
        </div>
    </div>



@endsection
