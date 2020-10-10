@extends('layouts.app')


@section('content')

    <link rel="stylesheet" href="/css/bloc/bloc.css">
    <br>
    <div class="container text-center">
        <div class="text-center">
            <h5 style="color: white;">Titre de la page : <b id="title">{{ $page->title }}</b></h5>
        </div>
        <div>
            <p style="color: white;">Description :</p>
            <p  style="color: white;" id="description">{{ $page->description }}</p>
        </div>
        <br>

        <div class="container text-center">
            <button class="btn btn-dark text-left" id="btnEdit" data-toggle="modal" data-target="#modalUpdate">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                Editer la page
            </button>
            <button class="btn btn-secondary text-center" id="btnNewBloc" data-toggle="modal"
                    data-target="modalNewBloc" onclick="openNavCreate()">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Nouveau bloc
            </button>
            @if(Auth::user()->can('delete',$page))
            <button class="btn btn-danger text-right" id="btnDelete" data-toggle="modal" data-target="#modalDelete">
                <i class="fa fa-ban" aria-hidden="true"></i>
                Supprimer la page
            </button>
            @endif
        </div>
    </div>
    <div class="container">
        <hr>
        <input type="text" id="myInput" class="form-control w-100" placeholder="Rechercher un bloc...">
    </div>
    <div id="bloc" class="container">

    </div>
    <!-- Suppression modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Supprimer la page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer la page ?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('page.destroy.fix', $page->id) }}" type="button" class="btn btn-danger">
                        Supprimer
                    </a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- update modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-2" role="dialog" id="modalUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('page.update', $page->id) }}" class="comment-form contact-form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier les informations de la page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="title">Titre de la page</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="{{ $page->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description de la page</label>
                                <textarea type="textarea" class="form-control" id="description" name="description"
                                          placeholder="{{$page->description}}"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="image"/>
                            </div>
                            <div class="form-group">
                                <label for="image"><i>Image actuelle :</i></label>
                                <br>
                                @if($page->image === 'default_page.png')
                                    <img src="/storage/default/{{ $page->image }}" height="300px">
                                @else
                                    <img src="/storage/pages/{{ $page->user_id }}/{{ $page->image }}" height="300px">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="modifier">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="sidenavUpdate" class="sidenavUpdate">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavUpdate()">&times;</a>
        <p hidden id="bloc_id"></p>
        <label for="title" id="labelTitle"><b>Titre du bloc :</b></label>
        <input type="text" name="title" id="inputTitle" value="" class="form-control" onchange="updateBlockTitle(this.value)">
        <button class="btn btn-danger" id="deleteBloc" onclick="deleteBlock();closeNavUpdate()">Supprimer le bloc</button>
    </div>

    <div id="sidenavCreate" class="sidenavCreate">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavCreate()">&times;</a>
        <h4>Type du bloc :</h4>
        <div class="container" id="buttonsBlocs">
            <button class="btn btn-dark" id="btnBlocText">Texte</button>
            <button class="btn btn-dark" id="btnBlocImage">Image</button>
            <button class="btn btn-dark" id="btnBlocVideo">Video</button>
            <button class="btn btn-dark" id="btnBlocScript">Script</button>
            <hr>
            <!-- ZONE DE RECUP DU CONTENU DU BLOC-->
            <div id="blocContent">

            </div>
        </div>
    </div>

    <div id="modalImage" class="modal">
        <span class="close" onclick="closeModalImage()">&times;</span>
        <img class="modal-content" id="img">
        <div id="caption"></div>
    </div>



    <script>

        $(document).ready(function () {
            $('#btnBlocText').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.text', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocImage').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.image', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocVideo').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.video', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnBlocScript').click(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("blocContent").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", '{{ route('bloc.script', $page->id) }}', true);
                xhttp.send();
            });
            $('#btnSaveBloc').click(function () {
                $('#blocForm').submit();
            })

            $("#myInput").on("keyup", function() {
                var input, filter, cards, cardContainer, h5, title, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementById("bloc");
                cards = cardContainer.getElementsByClassName("col-md-4");
                for (i = 0; i < cards.length; i++) {
                    title = cards[i].querySelector(".card .card-header h5");
                    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                        cards[i].style.display = "";
                    } else {
                        cards[i].style.display = "none";
                    }
                }
            });

        });



        $(window).on("load",function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("bloc").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", '{{ route('bloc.index', $page->id) }}', true);
            xhttp.send();
        })

    </script>

    <script>

        function openModalImage(img,title){
            imgMod = document.getElementById("img");
            var captionText = document.getElementById("caption");

            document.getElementById("modalImage").style.display = "block";
            imgMod.src = img.src;
            captionText.innerHTML = title.toString();

        }

        function closeModalImage(){
            document.getElementById("modalImage").style.display = "none";
        }


        function addBlocs() {
            const title = document.getElementById("titleNewBloc").value;
            const type = document.getElementById("typeNewBloc").value;

            if (type === 'video' || type === 'image'){
                content = document.getElementById("contentNewBloc").files[0];
            }
            else{
                content = document.getElementById("contentNewBloc").value;
            }

            var formData = new FormData();

            formData.append('title',title);
            formData.append('type',type);
            formData.append('content',content);

            $.ajax({
                type:'POST',
                contentType: false,
                processData: false,
                data: formData,
                url:"{{route('bloc.create', $page->id)}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    document.getElementById("bloc").innerHTML = data;
                }
            });
        }

        function deleteBlock(){
            id =  document.getElementById("bloc_id").innerText
            $.ajax({
                type:'GET',
                url:"{{route('bloc.destroy')}}/"+id,
                success:function(data){
                    document.getElementById("bloc").innerHTML = data;
                }
            });
        }

        function updateBlockText(textarea,id){

            $.ajax({
                type:'POST',
                data: {'content':textarea},
                url:"{{route('bloc.update')}}/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    document.getElementById("bloc").innerHTML = data;
                }
            });
        }

        function updateBlockTitle(title){

            id =  document.getElementById("bloc_id").innerText
            $.ajax({
                type:'POST',
                data: {'title':title},
                url:"{{route('bloc.update')}}/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    document.getElementById("bloc").innerHTML = data;
                }
            });
        }

        function updateBlockScript(textarea,id){

            $.ajax({
                type:'POST',
                data: {'content':textarea},
                url:"{{route('bloc.update')}}/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                    document.getElementById("bloc").innerHTML = data;
                }
            });
        }

        //SidenavDelete

        function openNavUpdate(cardHeader,id) {
            document.getElementById("sidenavUpdate").style.width = "250px";
            document.getElementById("inputTitle").value = cardHeader.innerText;
            document.getElementById("bloc_id").innerHTML = id;
            document.getElementById("deleteBloc").href = '{{ route('bloc.destroy') }}/'+id;
        }

        function closeNavUpdate() {
            document.getElementById("sidenavUpdate").style.width = "0";
        }

        //SideNav create

        function openNavCreate() {
            document.getElementById("sidenavCreate").style.width = "325px";
        }

        function closeNavCreate() {
            document.getElementById("sidenavCreate").style.width = "0";
        }
    </script>
@stop
