<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    @php
        $routeName = request()
            ->route()
            ->getName();
    @endphp
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => str_starts_with($routeName, 'blog.')]) aria-current="page" href="{{ route('blog.index') }}">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>

                <div class="d-flex">
                    <div class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                        <div class="nav-link ">
                            {{ Auth::user()->name }}
                        </div>
                            <form class="nav-item" action="{{ route('logout') }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="nav-link">Se déconnecter</button>
                            </form>
                        @endauth
                        @guest
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('inscrire') }}">S'inscrire</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>
