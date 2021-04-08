<header id="header">
    <h1><a href={{ route('home') }}>Ecourt</a></h1>
    <nav id="nav">
        <ul>
            <li><a href="#">Active cases</a></li>
            <li><a href="#">Complete cases</a></li>
            <li><a href="#">Your profile</a></li>
            <li>
            <a class="button special" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                {{ __('Sign out') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</header>
