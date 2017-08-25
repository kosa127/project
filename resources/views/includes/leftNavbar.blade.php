<ul class="nav navbar-nav">
    @if(Auth::guest())
    @elseif(Auth::user()->hasRole('Administrator'))
        &nbsp;      <li>
            <a href="{{ route('users.index') }}">
                Manage users
            </a>
        </li>
    @endif


    @if(Auth::guest())
    @elseif(Auth::user()->hasAnyRole(['Administrator', 'User']))
        <li>
            <a href="{{ route('expenses.index') }}">
                Manage expenses
            </a>
        </li>
    @endif


    @if(Auth::guest())
    @elseif(Auth::user()->hasRole('Administrator'))
        <li>
            <a href="{{ route('payments.index') }}">
                Manage payments
            </a>
        </li>
    @endif
</ul>