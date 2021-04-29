<!-- Header Section Begin -->
<header class="header-section">
    <div class="container-fluid">
        <div class="nav-menu" >
            @if(session()->get('api_token'))
                @include('incs.auth.header')
            @else
                @include('incs.ano.header')
            @endif
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->
