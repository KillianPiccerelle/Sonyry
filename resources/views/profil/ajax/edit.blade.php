@php
    $user = Auth::user();
@endphp

<form id="profilForm">
    <div class="row" >
        <div class="col-md-4 pt-3 ">
            <label for="newName">Nom</label>
            <input type="text" name="newName" value="{{ $user->name }}">

            <label for="newFirstname">Prénom</label>
            <input type="text" name="newFirstname" value="{{ $user->firstName }}"><br>

            <label for="newEmail">Email</label>
            <input type="email" id="inputEmail" @error('email') is-invalid @enderror"
            name="newEmail"
            value="{{ $user->email }}" autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
            @enderror<br>


            <label for="newJob">Emploi</label>
            <input type="text" name="newJob" value="{{ $user->job }}"><br>

            <label for="newJobSegment">Secteur d'activité</label>
            <input type="text" name="newJobSegment" value="{{ $user->businessSegment }}"><br>

            <label for="newStreet">Rue</label>
            <input type="text" name="newStreet" value="{{ $user->streetAddress }}"><br><br>

        </div>


        <div class="col-md-4  " style="padding-top: 1rem">
            <label for="newCity">Ville</label>
            <input type="text" name="newCity" value="{{ $user->cityAddress }}"><br>

            <label for="newPostalCode">Code Postal</label>
            <input maxlength="5" type="text" name="newPostalCode"
                   value="{{ $user->postCodeAddress }}"><br>

            <label for="newCountry">Pays</label>
            <input type="text" name="newCountry" value="{{ $user->country }}"><br>

            <label for="newMobilePhone">Téléphone portable</label>
            <input maxlength="10" type="text" name="newMobilePhone"
                   value="{{ $user->mobilePhone }}"><br>

            <label for="newWorkPhone">Téléphone de travail</label>
            <input maxlength="10" type="text" name="newWorkPhone"
                   value="{{ $user->businessPhone }}"><br>


        </div>
    </div>
    <div class="form-group">
        <label style="width: 300px" for="newDescription">Description (255 caractères maximum)
            :</label>
        <textarea class="form-control" id="exampleFormControlTextarea1"
                  name="newDescription"
                  rows="3">{{ $user->description }}</textarea>
    </div>


    <button type="button" id="btnSubmitForm" onclick="ajaxUpdate()">Mettre à jour mon profil</button>
</form>



