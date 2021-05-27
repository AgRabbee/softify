<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <a class="navbar-brand" href="{{ url('/') }}">Softify</a>

    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">

            <!-- User Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user"></i></a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    @guest
                        <span class="dropdown-item dropdown-header">Sign In / Sign Up</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/signin') }}" class="dropdown-item">
                            <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/signup') }}" class="dropdown-item">
                            <i class="fas fa-user-plus mr-2"></i> Sign Up
                        </a>
                    @else
                        <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>

                        <div class="dropdown-divider"></div>

                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                    @endguest
                </div>
            </li>

        </ul>
    </div>
</nav>

