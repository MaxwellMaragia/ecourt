<header class="header_in is_fixed menu_fixed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div id="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('courtofarms.png') }}" width="40" height="40" alt="" class="logo_sticky">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <ul id="top_menu">
{{--                    <li><a href="{{ url('accepts') }}" class="btn btn-info btn-sm">Open acceptance case</a></li>--}}
{{--                    <li><a href="{{ url('denies') }}" class="btn btn-danger btn-sm">Open denial case</a></li>--}}

                    <li>
                        <div class="dropdown dropdown-user">
                            <a href="#0" class="logged" data-toggle="dropdown"><img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="{{ route('profile.edit',Auth::user()->id) }}">My profile settings</a></li>
                                    <li><a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"
                                        >Log Out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
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
                        <li><span><a href="{{ route('home') }}">Home</a></span></li>
                        <li><span><a href="#">Create case</a></span>
                            <ul>
                                <li><a href="{{ url('accepts') }}">Suspect accepts</a></li>
                                <li><a href="{{ url('denies') }}">Suspect denies</a></li>
                            </ul>
                        </li>
                        <li><span><a href="{{ route('total') }}">Cases</a></span>
                            <ul>
                                <li><a href="{{ route('total') }}">Total</a></li>
                                <li><a href="{{ route('closed') }}">Closed</a></li>
                                <li><a href="{{ route('pending') }}">Pending</a></li>
                            </ul>
                        </li>


                        <li class="d-block d-sm-none"><span><a class="btn_top"  href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">Logout</a></span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</header>
