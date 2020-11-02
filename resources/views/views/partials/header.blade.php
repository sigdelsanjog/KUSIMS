<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">
        <img class="navbar-brand-full" src="/img/ku-logo.png" width="50" height="50" alt="Modulr Logo">
        <img class="navbar-brand-minimized" src="/img/ku-logo.png" width="30" height="30" alt="Modulr Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto mr-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                @if (!is_null(Auth::user()->student))
                    <img class="img-avatar mx-1" src="/{{Auth::user()->student->image}}">
                @else
                    <img class="img-avatar mx-1" src="{{Auth::user()->avatar_url}}">
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow mt-2">
                <a class="dropdown-item">
                    {{ Auth::user()->name }}<br>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </a>
                <a class="dropdown-item" href="/profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <div class="divider"></div>
                <a class="dropdown-item" href="/change_password">
                    <i class="fas fa-key"></i> Password
                </a>
                <div class="divider"></div>
                <a class="dropdown-item" href="{{ route('auth.logout') }}" 
                    onclick="event.preventDefault(); 
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Logout 
                </a>
            </div>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</header>