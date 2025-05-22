<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Public Market')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding: 1rem;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1050;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .sidebar .navbar-brand {
            font-weight: 600;
            color: rgb(221, 102, 4) !important;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
            align-self: flex-end;
        }

        .main-wrapper {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            padding: 2rem;
        }

        .main-wrapper.shifted {
            margin-left: 250px;
        }

        /* Floating menu button */
        .floating-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: #fff;
            border: none;
            font-size: 1.5rem;
            padding: 8px 12px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .floating-btn:focus {
            outline: none;
        }

        .floating-btn.hide {
            display: none;
        }

        .badge {
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

<!-- Floating menu button -->
<button class="floating-btn" id="openSidebarBtn">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <button class="toggle-btn" id="closeSidebarBtn">
        <i class="bi bi-arrow-left"></i>
    </button>

    <a class="navbar-brand" href="{{ url('/') }}">
        <i class="bi bi-shop"></i> <span>Public Market</span>
    </a>

    <ul class="nav flex-column">
        @auth
            @if(auth()->user()->role === 'customer')
                <!-- Additional customer-specific links -->
            @endif

            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="bi bi-person"></i> <span>Profile</span>
                </a>
            </li>

            <li class="nav-item position-relative">
                <a href="{{ route('cart.index') }}" class="nav-link">
                    <i class="bi bi-cart"></i> <span>Cart</span>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="badge bg-danger ms-auto">{{ count(session('cart')) }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="customerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear"></i> <span>Account</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="customerDropdown">
                    <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
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
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i> <span>Login</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <i class="bi bi-person-plus"></i> <span>Register</span>
                </a>
            </li>
        @endauth
    </ul>
</nav>

<!-- Main Content -->
<div class="main-wrapper" id="mainWrapper">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const openBtn = document.getElementById('openSidebarBtn');
    const closeBtn = document.getElementById('closeSidebarBtn');
    const sidebar = document.getElementById('sidebar');
    const mainWrapper = document.getElementById('mainWrapper');

    openBtn.addEventListener('click', () => {
        sidebar.classList.add('show');
        mainWrapper.classList.add('shifted');
        openBtn.classList.add('hide');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('show');
        mainWrapper.classList.remove('shifted');
        openBtn.classList.remove('hide');
    });
</script>
</body>
</html>
