<ul class="nav navbar-nav">
    @if(Auth::guest())
    @elseif(Auth::user()->hasRole('Administrator'))
        &nbsp;      <li>
            <a href="{{ route('users.index') }}">
                Users
            </a>
        </li>
    @endif


    @if(Auth::guest())
    @elseif(Auth::user()->hasAnyRole(['Administrator', 'User']))
        <li>
            <a href="{{ route('expenses.index') }}">
                Expenses
            </a>
        </li>
    @endif


    @if(Auth::guest())
    @elseif(Auth::user()->hasRole('Administrator'))
        <li>
            <a href="{{ route('payments.index') }}">
                Payments
            </a>
        </li>
    @endif
</ul>