<form method="post" id="blocForm" action="{{ route('bloc.create', $page->id) }}" class="comment-form contact-form" enctype="multipart/form-data">
    @csrf
    <label for="title">Titre</label>
    <div class="form-group">
        <input id="title" name="title" class="form-control" type="text">
    </div>
    <input type="file" name="video"/>
</form>
