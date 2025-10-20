<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom styles to blend Bootstrap and Tailwind */
        .bg-light {
            background-color: #f8f9fa;
        }

        .font-sans {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <!-- Drawer Toggle Button -->
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarDrawer" aria-controls="sidebarDrawer">
                <i class="fas fa-bars"></i> Menu
            </button>

            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </div>
    </nav>

    <!-- Drawer (Bootstrap Offcanvas Sidebar) -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarDrawer"
        aria-labelledby="sidebarDrawerLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarDrawerLabel">Navigation</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body bg-dark text-white">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route('dashboard') }}"
                        class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route('job_posts.index') }}"
                        class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-briefcase me-2"></i> Job Posts
                    </a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route('categories.index') }}"
                        class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-tags me-2"></i> Categories
                    </a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="#" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-graduation-cap me-2"></i> Education
                    </a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="#" class="text-white text-decoration-none d-flex align-items-center">
                        <i class="fas fa-running me-2"></i> Sports
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="border-secondary my-3">

            <!-- User Dropdown -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu bg-dark text-white" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item text-white bg-dark" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider bg-secondary">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-white bg-dark">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>


    </div>

    <!-- Main Layout -->
    <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm mb-4">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container mx-auto px-4 py-8">
            @yield('content')
        </main>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div
            class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 ease-in-out">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-hide success message
        setTimeout(() => {
            const successMessage = document.querySelector('.fixed');
            if (successMessage) {
                successMessage.remove();
            }
        }, 3000);
    </script>
</body>

</html>