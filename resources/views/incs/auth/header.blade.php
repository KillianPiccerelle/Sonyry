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


@endphp

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm container-fluid" >
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Créer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('page.create') }}">{{ __('Créer une page')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{ route('collection.create') }}">{{ __('Créer une collection') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('group.create') }}">{{ __('Créer un groupe') }}</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modifier
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('page.index') }}">{{ __('Modifier mes pages')}}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{ route('collection.index') }}">{{ __('Modifier mes collection') }}</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Partager
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('share.indexPage') }}">{{ __('Partager mes pages')}}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Collaborer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('group.index') }}">{{ __('Mes groupes')}}</a>

                    </div>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a type="button" href="{{ route('inbox.index') }}" class="btn btn-primary">
                        Notifications <span class="badge badge-light">@if(count($inboxes) < 10) {{ count($inboxes) }} @else 9+ @endif</span>
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
                        <a id="username" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profil.index') }}">
                                {{__('Profil')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('page.index') }}">
                                {{__('Mes pages')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('collection.index') }}">
                                {{__('Mes collections')}}
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
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
