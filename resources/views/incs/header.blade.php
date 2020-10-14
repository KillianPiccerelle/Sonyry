@php


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
