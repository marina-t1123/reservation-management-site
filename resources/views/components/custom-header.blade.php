<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
{{--                    {{ config('app.name', 'Laravel') }}--}}
            <img src="{{ asset('img/logo.png') }}" alt="logo" width="80">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item mx-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-house"></i>
                                    <a class="nav-link" href="{{ route('top')}}">TOP</a>
                                </div>
                            </li>
                            <li class="nav-item mx-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-door-open"></i>
                                    <a class="nav-link" href="{{ route('rooms')}}">ROOM</a>
                                </div>
                            </li>
                            <li class="nav-item mx-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    {{-- <a class="nav-link" href="{{ route('plans.index')}}">PLAN</a> --}}
                                    <a class="nav-link" href="">PLAN</a>
                                </div>
                            </li>
                            <li class="nav-item mx-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                    <a class="nav-link" href="{{ route('access')}}">ACCESS</a>
                                </div>
                            </li>
                            <li class="nav-item mx-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-envelope"></i>
                                    <a class="nav-link" href="{{ route('')}}">CONTACT</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mx-2">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Admin Login') }}</a>
                            </div>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item mx-2">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-registered"></i>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Admin Register') }}</a>
                            </div>

                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- フラッシュメッセージ -->
{{-- @include('components.parts.flash_message') --}}
