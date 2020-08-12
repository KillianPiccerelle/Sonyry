
<ul class="nav flex-column" style="width: 10%">
    <li class="nav-item ml-3">
        <a class="nav-link" href="{{ route('group.show',$group->id) }}">Accueil</a>
    </li>
    <li class="nav-item ml-3">
        <a class="nav-link" href="{{ route('group.share', $group->id) }}">Partager</a>
    </li>
    @can('can-edit-group',$group->user_id)
    <li class="nav-item ml-3">
        <a class="nav-link" href="{{ route('group.edit', $group->id) }}">Paramètres</a>
    </li>
    @endcan
    @if($group->user_id !== Auth::user()->id)
        <li class="nav-item ml-3">
            <br>
            <a href=" {{ route('group.exit', $group->id) }}" class="btn btn-danger">Quitter</a>
        </li>
    @endif

</ul>

