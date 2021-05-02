<header class="header menu_fixed">
    <div id="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('courtofarms.png') }}" width="50" height="50" alt="" class="logo_normal">
            <img src="{{ asset('courtofarms.png') }}" width="50" height="50" alt="" class="logo_sticky">
        </a>
    </div>
    <ul id="top_menu">
        <li><a href="{{ route('login') }}" class="btn_top">Sign in</a></li>
    </ul>
    <!-- /top_menu -->
    <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>
    <nav id="menu" class="main-menu">
        <ul>
            <li><span><a href="{{ url('/') }}">Home</a></span></li>
            <li><span><a href="#">Help section</a></span></li>
            <li class="d-block d-sm-none"><span><a href="{{ route('login') }}" class="btn_top">Sign in</a></span></li>
        </ul>
    </nav>
</header>
