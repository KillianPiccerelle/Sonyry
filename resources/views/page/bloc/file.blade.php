<div class="container text-center">
    <i>Bloc Fichier</i>
</div>
<hr>
<label for="title">Titre du bloc :</label>
<div class="form-group">
    <input id="titleNewBloc" name="title" class="form-control" placeholder="Titre..." type="text">
    <br>
    <label for="content">Ajoutez un fichier :</label>
    <input type="file" id="contentNewBloc" name="content" required/>
</div>

<input type="hidden" id="typeNewBloc" name="type" value="file"/>

<button class="btn btn-primary" id="btnAddBlocAjax" onclick="addBlocs()">
    Valider
    <i class="fas fa-check"></i>
</button>

<style>
    #titleNewBloc {
        border: solid black 1px;
    }
</style>
