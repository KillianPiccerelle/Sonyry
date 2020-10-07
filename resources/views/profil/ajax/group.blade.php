@if(count(Auth::user()->groupsMember) > 0)
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom du groupe</th>
            <th scope="col">Nombre de personnes dans le groupe</th>
        </tr>
        </thead>
        <tbody>
        @foreach(Auth::user()->groupsMember as $group)

            <tr>
                <td>{{ $group->group->name }}</td>
                <td>{{ count($group->group->members) }}</td>
            </tr>
        @endforeach
        @else
            <p>Vous n'appartenez actuellement à aucun groupe.</p>
        @endif
    </table>
