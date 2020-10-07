@php
    $user = Auth::user();
@endphp

<div class="row">
    <div class="col-md-4 pt-3 ">
        Nom :<br>
        Prénom :<br>
        Email :<br>
        Emploi :<br>
        Secteur d'activité :<br>
        Rue :<br>
        Ville :<br>
        Code Postal :<br>
        Pays :<br>
        Téléphone portable :<br>
        Téléphone de travail :<br><br>
    </div>
    <div class="col-md-4  " style="padding-top: 1rem; font-weight: bold;" >

        {{ $user->name }}<br>
        {{ $user->firstName }}<br>
        {{ $user->email }}<br>
        {{ $user->job }}<br>
        {{ $user->businessSegment }}<br>
        {{ $user->streetAddress }}<br>
        {{ $user->cityAddress }}<br>
        {{ $user->postCodeAddress }}<br>
        {{ $user->country }}<br>
        {{ $user->mobilePhone }}<br>
        {{ $user->businessPhone }}<br>
    </div>
</div>
<div class="form-group">
    <label for="newDescription">Description : <br></label>
    <textarea disabled class="form-control" id="exampleFormControlTextarea1"
              name="newDescription" rows="3"
              placeholder="{{ $user->description }}"></textarea>
</div>
