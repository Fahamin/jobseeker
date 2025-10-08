<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <!-- Drawer Toggle Button -->
            <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarDrawer" aria-controls="sidebarDrawer">
                <i class="bi bi-list"></i> Menu
            </button>

            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Right Side Navbar -->
                <ul class="navbar-nav ms-auto">
                
                    <li class="nav-item"><a class="nav-link" href="{{  route('categories.index')  }}">Categories</a>
                  </li>
                    <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Drawer (Bootstrap Offcanvas Sidebar) -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarDrawer"
        aria-labelledby="sidebarDrawerLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sidebarDrawerLabel">Categories</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route("job_posts.index") }}" class="text-white text-decoration-none">JobPost</a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">Dashboard</a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="{{ route('categories.index')  }}" class="text-white text-decoration-none">Categories</a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="#" class="text-white text-decoration-none">Education</a>
                </li>
                <li class="list-group-item bg-dark text-white border-0">
                    <a href="#" class="text-white text-decoration-none">Sports</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm mb-4">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>

</html>