<div class="container text-center">
    <i>Bloc vidéo</i>
</div>
<hr>
<label for="title">Titre du bloc :</label>
<div class="form-group">
    <input id="titleNewBloc" name="title" class="form-control" placeholder="Titre..." type="text">
    <br>
    <label for="content">Ajoutez une video :</label>
    <input type="file" id="contentNewBloc" name="content" accept="video/*" required/>
</div>

<input type="hidden" id="typeNewBloc" name="type" value="video"/>

<button class="btn btn-primary" id="btnAddBlocAjax" onclick="addBlocs()">
    Valider
    <i class="fas fa-check"></i>
</button>

<style>
    #titleNewBloc {
        border: solid black 1px;
    }
</style>
