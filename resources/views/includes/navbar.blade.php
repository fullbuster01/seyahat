    <!-- navbar -->
    <div class="container">
        <nav class="row navbar navbar-expand-lg navbar-light bg-white">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ url('frontend/images/logo.png') }}" alt="Logo Seyahat">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('home') }}" class="nav-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Paket Travel</a>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                @if ($category->travel_package->count())
                                <a href="{{ route('category', $category->name) }}" class="dropdown-item">{{ $category->name }}</a>
                                <div class="dropdown-divider"></div>
                                @endif
                            @endforeach
                            <a href="{{ route('travels') }}" class="dropdown-item">All Travels</a>
                        </div>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#" class="nav-link">Services</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#testimonialContent" class="nav-link">Testimonial</a>
                    </li>
                </ul>

                @guest
                    <!-- mobile  button -->
                    <form action="#" class="form-inline d-sm-block d-md-none">
                        <button class="btn btn-login my-2 my-sm-0" type="button" onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                            Masuk
                        </button>
                    </form>

                    <!-- deskop  button -->
                    <form action="#" class="form-inline my-2 my-lg-0 d-none d-md-block">
                        <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                            Masuk
                        </button>
                    </form>
                @endguest

                @auth
                    <!-- mobile  button -->
                    <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}" method="POST">
                        {{-- @method('DELETE') --}}
                        @csrf
                        <button class="btn btn-login my-2 my-sm-0" type="submit">
                            logout
                        </button>
                    </form>

                    <!-- deskop  button -->
                    <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}" method="POST">
                        {{-- @method('DELETE') --}}
                        @csrf
                        <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                            logout
                        </button>
                    </form>
                @endauth
            </div>
        </nav>

    </div>