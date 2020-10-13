@php

    $user = \App\RoleUser::where('user_id', Auth::user()->id)->get();
    $teacher =$user[0]->role_id == 2;
    $jury = $user[0]->role_id == 4;
    @endphp

<!-- Header Section Begin -->
<header class="header-section">
    <div class="container-fluid">
        <div class="nav-menu" >
            @if (Auth::check())
                @include('incs.auth.header')
            @else
                @include('incs.ano.header')
            @endif
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->
