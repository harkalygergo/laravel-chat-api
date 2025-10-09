<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">💬 LaraTalk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('friends') }}">Search friends</a>
                    </li>
                @endauth
            </ul>
            <div class="ms-auto d-flex gap-2 align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light">Login / Register</a>
                @endguest

                @auth
                    <span class="navbar-text text-light me-2">Logged in as {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
    </nav>


