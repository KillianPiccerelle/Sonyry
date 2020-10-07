<nav>
    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-pages-tab" data-toggle="tab"
           href="#nav-pages" role="tab" aria-controls="nav-pages" aria-selected="true">Pages</a>

        <a class="nav-item nav-link" id="nav-collections-tab" data-toggle="tab"
           href="#nav-collections" role="tab" aria-controls="nav-collections"
           aria-selected="false">Collections</a>
    </div>
</nav>

<div style="border-bottom: none" class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active " id="nav-pages" role="tabpanel "
         aria-labelledby="nav-collections-tab">

        @if(count(Auth::user()->pages) > 0)
            @foreach(Auth::user()->pages as $page)
                <div class="list-group" style="margin-left: -900px" >
                    <div class="post">
                        <p> {{ ucfirst($page->title) }}<p>
                    </div>
                </div>
            @endforeach
        @else
            <p>Vous n'avez aucune page.</p>
        @endif
    </div>

    <div class="tab-pane fade show " id="nav-collections" role="tabpanel"
         aria-labelledby="nav-collections-tab">

        @if(count(Auth::user()->collections) > 0)
            @foreach(Auth::user()->collections as $collection)

                <div class="post" style="margin-left: 900px">
                    <p> {{ ucfirst($collection->name) }}<p>
                </div>

            @endforeach
        @else
            <p>Vous n'avez aucune collection.</p>
        @endif
    </div>
</div>
