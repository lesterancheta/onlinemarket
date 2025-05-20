<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Public Market')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional but modern) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 600;
            color:rgb(221, 102, 4) !important;
        }
        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color:rgb(219, 120, 7) !important;
        }
        .btn-link.nav-link {
            color:rgb(226, 72, 0) !important;
        }
        .container {
            max-width: 960px;
        }

        .navbar-text {
    white-space: nowrap;
    margin-left: 1rem;
}

@media (max-width: 576px) {
    .navbar-text {
        font-size: 1rem !important; /* scale down on small screens */
        margin-left: 0;
    }
}
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Public Market
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                @auth
                    @if(auth()->user()->role === 'customer')
                      
                    @endif
<li class="nav-item">
    <a href="{{ route('profile.edit') }}" class="nav-link p-0">
        <div class="text-center d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <span style="font-size: 20px;">👤</span>
        </div>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cart.index') }}" class="nav-link p-0 position-relative">
        <div class="text-center d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
            <span style="font-size: 20px;">🛒</span>
        </div>
        @if(session('cart') && count(session('cart')) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count(session('cart')) }}
                <span class="visually-hidden">items in cart</span>
            </span>
        @endif
    </a>
</li>


                    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Account
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customerDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
            </form>
        </li>
    </ul>
</li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
