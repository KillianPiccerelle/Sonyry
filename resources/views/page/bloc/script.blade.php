<div class="container text-center">
    <i>Bloc script</i>
</div>
<hr>
<div class="form-group">
    <label for="title">Titre du bloc :</label>
    <input id="titleNewBloc" name="title" class="form-control" placeholder="Titre..." type="text">
    <br>
    <label for="content"> Contenu du bloc :</label>
    <textarea id="contentNewBloc" class="form-control" name="content" placeholder="Saisissez votre code"></textarea>
</div>
<input type="hidden" id="typeNewBloc" name="type" value="script"/>

<button class="btn btn-primary" id="btnAddBlocAjax" onclick="addBlocs()">
    Valider
    <i class="fas fa-check"></i>
</button>


<style>
    #titleNewBloc {
        border: solid black 1px;
    }
    #contentNewBloc {
        border: solid black 1px;
    }
</style>

