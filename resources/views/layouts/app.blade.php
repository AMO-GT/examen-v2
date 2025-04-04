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

            /* Footer styles */
            .footer {
                background-color: #2D3748;
                color: #f8f9fa;
                font-size: 0.95rem;
            }

            .footer-title {
                font-weight: 600;
                color: white;
                position: relative;
                padding-bottom: 0.8rem;
                margin-bottom: 1rem;
            }

            .footer-title::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 40px;
                height: 3px;
                background: var(--gradient-primary);
            }

            .footer-description {
                color: #cbd5e0;
                line-height: 1.6;
            }

            .social-icons {
                display: flex;
                gap: 12px;
            }

            .social-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                transition: all 0.3s ease;
            }

            .social-icon:hover {
                background: var(--gradient-primary);
                transform: translateY(-3px);
                color: white;
            }

            .footer-hours, .footer-contact {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .footer-hours li, .footer-contact li {
                padding: 0.4rem 0;
                color: #cbd5e0;
            }

            .footer-hours span {
                font-weight: 600;
                color: white;
                display: inline-block;
                width: 100px;
            }

            .footer-contact li {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .footer-contact li i {
                color: var(--accent-color);
                font-size: 1rem;
            }

            .btn-outline-light {
                border-color: var(--accent-color);
                color: white;
            }

            .btn-outline-light:hover {
                background: var(--gradient-primary);
                border-color: transparent;
            }

            .footer-divider {
                height: 1px;
                background-color: rgba(255, 255, 255, 0.1);
                margin: 2rem 0 1.5rem;
            }

            .copyright {
                color: #a0aec0;
                font-size: 0.9rem;
            }

            .footer-links {
                list-style: none;
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: flex-end;
                gap: 20px;
            }

            .footer-links li a {
                color: #a0aec0;
                text-decoration: none;
                transition: color 0.3s ease;
                font-size: 0.9rem;
            }

            .footer-links li a:hover {
                color: white;
            }

            @media (max-width: 767px) {
                .footer-links, .copyright {
                    text-align: center;
                }
                
                .footer-links {
                    justify-content: center;
                    margin-top: 1rem;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">The Hair Hub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('klanten.index') ? 'active' : '' }}" href="{{ route('klanten.index') }}">Klanten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('beheerders.index') ? 'active' : '' }}" href="{{ route('beheerders.index') }}">Beheerders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('medewerkers.index') ? 'active' : '' }}" href="{{ route('medewerkers.index') }}">Medewerkers</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profiel</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Uitloggen</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Inloggen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registreren</a>
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

        <!-- Footer -->
        <footer class="footer mt-5 pt-5 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">The Hair Hub</h5>
                        <p class="footer-description">Uw vertrouwde kapsalon voor een frisse look en professionele haarverzorging. Wij staan klaar om u de beste service te bieden.</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Openingstijden</h5>
                        <ul class="footer-hours">
                            <li><span>Maandag:</span> 09:00 - 17:00</li>
                            <li><span>Dinsdag:</span> 09:00 - 17:00</li>
                            <li><span>Woensdag:</span> 09:00 - 17:00</li>
                            <li><span>Donderdag:</span> 09:00 - 20:00</li>
                            <li><span>Vrijdag:</span> 09:00 - 17:00</li>
                            <li><span>Zaterdag:</span> 10:00 - 18:00</li>
                            <li><span>Zondag:</span> 12:00 - 16:00</li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-title">Contact</h5>
                        <ul class="footer-contact">
                            <li><i class="fas fa-map-marker-alt"></i> Kapsalonstraat 123, 1234 AB Amsterdam</li>
                            <li><i class="fas fa-phone"></i> 020 - 123 45 67</li>
                            <li><i class="fas fa-envelope"></i> info@thehairhub.nl</li>
                        </ul>
                        <div class="mt-3">
                            <a href="#" class="btn btn-outline-light btn-sm">Contact opnemen</a>
                        </div>
                    </div>
                </div>
                <div class="footer-divider"></div>
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>&copy; {{ date('Y') }} The Hair Hub. Alle rechten voorbehouden.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <ul class="footer-links">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Algemene Voorwaarden</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

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
    </body>
</html>
