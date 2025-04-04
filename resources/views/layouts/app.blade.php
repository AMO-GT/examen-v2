<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- AOS Animation -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            :root {
                --primary-purple: #6B46C1;
                --primary-blue: #0047AB;
                --accent-color: #9F7AEA;
                --text-color: #2D3748;
                --light-bg: #F7FAFC;
                --gradient-primary: linear-gradient(135deg, #6B46C1, #0047AB);
                --gradient-hover: linear-gradient(135deg, #0047AB, #6B46C1);
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
                color: var(--text-color);
                line-height: 1.6;
                padding-top: 60px;
            }

            .navbar {
                background-color: rgba(255, 255, 255, 0.98) !important;
                box-shadow: 0 2px 15px rgba(0,0,0,0.05);
                padding: 1rem 0;
                transition: all 0.3s ease;
            }

            .navbar.scrolled {
                padding: 0.5rem 0;
                background-color: rgba(255, 255, 255, 0.98) !important;
            }

            .navbar-brand {
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                font-weight: bold;
                font-size: 1.5rem;
                letter-spacing: 1px;
            }

            .nav-link {
                color: var(--text-color) !important;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                color: var(--primary-purple) !important;
            }

            .nav-link.active {
                color: var(--primary-purple) !important;
                font-weight: 600;
            }

            .dropdown-menu {
                border: none;
                box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            }

            .dropdown-item {
                color: var(--text-color);
            }

            .dropdown-item:hover {
                background: var(--light-bg);
                color: var(--primary-purple);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(135deg, #6B46C1 0%, #2C5282 100%);">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ route('home') }}">
                    <i class="fas fa-cut me-2"></i>The Hair Hub
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('medewerkers.index') }}">
                                <i class="fas fa-list me-1"></i>Behandelingen
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link text-white border-0 bg-transparent">
                                        <i class="fas fa-sign-out-alt me-1"></i>Uitloggen
                                    </button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- AOS Animation -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
            
            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.querySelector('.navbar').classList.add('scrolled');
                } else {
                    document.querySelector('.navbar').classList.remove('scrolled');
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
