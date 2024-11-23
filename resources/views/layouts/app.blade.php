<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navigation link styles */
        .nav-link {
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }
    
        .nav-link:hover {
            background-color: #f0f0f0;
            color: #000;
        }
    
        .nav-item.active > .nav-link {
            background-color: #d6d6d6; /* Selected background color */
            color: #000; /* Selected text color */
        }

        .container {
            margin-top: 100px;
        }

        h1.display-4 {
            font-size: 6rem;
            font-weight: bold;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">My Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                    </li> --}}
                    @php
                    $role = Auth::user()->role;
                    $menuConfig = config('navigation.menus');
                    // $menus = array_merge($menuConfig['shared'], $menuConfig[$role] ?? []);
                    $menus = $menuConfig[$role];
                    @endphp

                    @foreach($menus as $label => $route)
                        <li class="nav-item {{ request()->routeIs($route) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route($route) }}">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(View::hasSection('header'))
            <div class="bg-light p-3 mb-4 rounded">
                <h1 class="h4">@yield('header')</h1> <!-- Render header section -->
            </div>
        @endif

        @yield('content') <!-- Render the content section -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
