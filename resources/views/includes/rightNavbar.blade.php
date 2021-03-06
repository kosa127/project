<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    @else
        @if(Auth::user()->hasRole('User'))
            <li><a href="{{ route('users.show',  Auth::user()->id) }}">My expenses & payments</a></li>

        @endif
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
               Logged in as: <b>{{ Auth::user()->name }}</b>  <span class="caret"></span>
            </a>

            <ul class="dropdown-menu inverse-dropdown" data-toggle="dropdown" role="menu">
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    @endif
</ul>