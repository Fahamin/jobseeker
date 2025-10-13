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

            <!-- <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a> -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="hidden sm:flex sm:items-center sm:ms-6 sm:justify-end">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->

                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
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