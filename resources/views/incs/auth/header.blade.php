@php

    /** Récup les notif */
        $inboxes = \App\Inbox::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->get();
        $count = 0;

        /** si y'a des notifs */
    if (count($inboxes) >0)
    {
            /** je test si la notif est à la corbeille, si c'est le cas je l'enlève de la liste */
        foreach ($inboxes as $inbox)
        {
            if ($inbox->notification->trash === 1){
                unset($inboxes[$count]);
            }
            $count++;
        }
    }


$rolePolicy = new \App\RoleUserPolicy();

@endphp

<style>

</style>

<nav class="navbar navbar-expand-md navbar-light  shadow-sm container-fluid"
     style="fill: transparent">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="https://media.discordapp.net/attachments/718040099618685009/718041074169413775/unknown.png" alt=""
                 width="100%" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="color: white"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Créer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{ route('collection.create') }}">{{ __('Créer une rubrique') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('page.create') }}">{{ __('Créer une page')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('group.create') }}">{{ __('Créer un groupe') }}</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="color: white"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modifier
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{ route('collection.index') }}">{{ __('Modifier mes rubriques') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('page.index') }}">{{ __('Modifier mes pages')}}</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" style="color: white"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Collaborer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('group.index') }}">{{ __('Mes groupes')}}</a>
                        <a class="dropdown-item" href="{{ route('topics.index') }}">{{ __('Forum')}}</a>
                    </div>
                </li>
                @if(Request::is('topics*','categorie*'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           style="color: white"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Forum
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="{{ route('topics.create') }}">{{ __('Créer un topic')}}</a>
                            @if($rolePolicy->role($rolePolicy->getAdmin()) || $rolePolicy->role($rolePolicy->getTeacher()))
                                <a class="dropdown-item"
                                   href="{{ route('categorie.create') }}">{{ __('Créer une catégorie')}}</a>
                            @endif
                        </div>
                    </li>
                @endif
                @if($rolePolicy->role($rolePolicy->getJury()) || $rolePolicy->role($rolePolicy->getTeacher()))
                    <li class="nav-item">
                        <a class="nav-link" style="text-decoration: none; color: #ffffff"
                           href="{{route('teacher.index')}}">Espace professeur et jury</a>
                    </li>
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a type="button" href="{{ route('inbox.index') }}" class="btn btn-primary">
                        Notifications <span
                            class="badge badge-light">@if(count($inboxes) < 10) {{ count($inboxes) }} @else
                                9+ @endif</span>
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profil.index') }}">
                                {{__('Profil')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('page.index') }}">
                                {{__('Mes pages')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('collection.index') }}">
                                {{__('Mes rubriques')}}
                            </a>
                            <a class="dropdown-item" href="#">
                                {{__('Documents partagés avec moi')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('inbox.index') }}">
                                {{__('Boîte de réception')}}
                            </a>
                            <a class="dropdown-item" href="#">
                                {{__('Préférence')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Se déconnecter') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           style="color: white"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->firstName }} <span class="caret"></span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
