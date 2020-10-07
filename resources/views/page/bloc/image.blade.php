<div class="container text-center">
    <i>Bloc image</i>
</div>
<hr>
<label for="title">Titre du bloc :</label>
<div class="form-group">
    <input id="titleNewBloc" name="title" class="form-control" placeholder="Titre..." type="text">
    <br>
    <label for="content">Ajoutez une image :</label>
    <input type="file" id="contentNewBloc" name="content" accept="image/x-png,image/gif,image/jpeg" required/>
</div>

<input type="hidden" name="type" id="typeNewBloc" value="image"/>

<button class="btn btn-primary" id="btnAddBlocAjax" onclick="addBlocs()">
    Valider
    <i class="fas fa-check"></i>
</button>

<style>
    #titleNewBloc {
        border: solid black 1px;
    }
</style>
