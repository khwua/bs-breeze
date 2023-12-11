<header class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-sm btn-success" href="{{ route('register') }}">
                            {{ __('Create an account') }}
                        </a>
                        <a class="btn btn-sm btn-light" href="{{ route('login') }}">
                            {{ __('Sign in') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf

                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>

                                <button type="submit" form="logout-form" class="dropdown-item">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
