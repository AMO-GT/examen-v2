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
                background: var(--gradient-primary) !important;
                box-shadow: 0 2px 15px rgba(0,0,0,0.1);
                padding: 1rem 0;
            }

            .navbar-brand, .nav-link {
                color: white !important;
            }

            .dropdown-menu {
                margin-top: 0.5rem;
                border: none;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                background: white;
                padding: 0.5rem;
            }

            .dropdown-item {
                color: var(--text-color);
                padding: 0.5rem 1rem;
                border-radius: 4px;
            }

            .dropdown-item:hover {
                background: var(--light-bg);
                color: var(--primary-purple);
            }

            .dropdown-item i {
                width: 20px;
                text-align: center;
                margin-right: 8px;
                color: var(--primary-purple);
            }

            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
            }

            .navbar-toggler {
                border-color: rgba(255,255,255,0.5);
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            /* Home Page Styling */
            .hero-section {
                background: linear-gradient(to right, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.8)), url('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                color: var(--text-color);
                padding: 12rem 0 8rem;
                position: relative;
                overflow: hidden;
                min-height: 90vh;
                display: flex;
                align-items: center;
                border-bottom: 1px solid rgba(107, 70, 193, 0.1);
            }

            .hero-content {
                position: relative;
                z-index: 2;
                background: rgba(255, 255, 255, 0.9);
                padding: 3rem;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(0, 71, 171, 0.1);
                backdrop-filter: blur(10px);
            }

            .hero-title {
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                font-size: 3.8rem;
                font-weight: 700;
                margin-bottom: 1.5rem;
                letter-spacing: 1px;
                line-height: 1.2;
            }

            .hero-subtitle {
                color: var(--text-color);
                font-size: 1.6rem;
                margin-bottom: 2.5rem;
                opacity: 0.9;
                letter-spacing: 0.5px;
                line-height: 1.6;
            }

            .section-title {
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                position: relative;
                margin-bottom: 3rem;
                font-size: 2.5rem;
                font-weight: 700;
                letter-spacing: 1px;
            }

            .section-title::after {
                content: '';
                display: block;
                width: 60px;
                height: 3px;
                background: var(--gradient-primary);
                margin: 1rem auto;
                transition: width 0.3s ease;
            }

            .vision-box {
                background-color: var(--light-bg);
                border-radius: 15px;
                padding: 3.5rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.05);
                transition: all 0.3s ease;
                border: 1px solid rgba(0,0,0,0.05);
            }

            .diagonal-section {
                position: relative;
                padding: 8rem 0;
                background: var(--light-bg);
            }

            .floating-card {
                background: white;
                border-radius: 30px;
                padding: 3rem;
                box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.05),
                           -20px -20px 60px rgba(255, 255, 255, 0.8);
                transform: translateY(50px);
            }

            .service-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
                margin-top: 4rem;
            }

            .service-item {
                position: relative;
                overflow: hidden;
                border-radius: 20px;
                transition: all 0.5s ease;
                height: 300px;
            }

            .service-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: var(--gradient-primary);
                opacity: 0;
                transition: all 0.5s ease;
            }

            .service-item:hover::before {
                opacity: 0.9;
            }

            .service-content {
                position: relative;
                z-index: 2;
                padding: 2rem;
                color: white;
                transform: translateY(100%);
                transition: all 0.5s ease;
            }

            .service-item:hover .service-content {
                transform: translateY(0);
            }

            .feature-box {
                padding: 2rem;
                border-radius: 20px;
                background: white;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .feature-box::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 4px;
                height: 0;
                background: var(--gradient-primary);
                transition: all 0.3s ease;
            }

            .feature-box:hover::before {
                height: 100%;
            }

            .floating-social {
                position: fixed;
                right: 30px;
                top: 50%;
                transform: translateY(-50%);
                display: flex;
                flex-direction: column;
                gap: 1rem;
                z-index: 1000;
            }

            .floating-social a {
                width: 45px;
                height: 45px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--primary-purple);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .floating-social a:hover {
                transform: translateX(-5px);
                background: var(--gradient-primary);
                color: white;
            }

            .btn-primary {
                background: var(--gradient-primary);
                border: none;
                padding: 1.2rem 2.8rem;
                border-radius: 50px;
                transition: all 0.3s ease;
                font-weight: 600;
                letter-spacing: 1px;
                text-transform: uppercase;
                font-size: 0.9rem;
                box-shadow: 0 10px 20px rgba(107, 70, 193, 0.2);
            }

            .btn-primary:hover {
                background: var(--gradient-hover);
                transform: translateY(-3px);
                box-shadow: 0 15px 30px rgba(107, 70, 193, 0.3);
            }

            footer {
                background: var(--gradient-primary);
                color: white;
                padding: 5rem 0 2rem;
                clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%);
            }

            .social-links a {
                color: white;
                font-size: 1.5rem;
                transition: all 0.3s ease;
                margin-right: 1.5rem;
            }

            /* Responsive Styles */
            @media (max-width: 1200px) {
                .hero-title {
                    font-size: 3rem;
                }
                
                .hero-subtitle {
                    font-size: 1.4rem;
                }

                .service-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 992px) {
                .hero-content {
                    padding: 2rem;
                }

                .hero-section {
                    padding: 8rem 0 4rem;
                    min-height: 70vh;
                }

                .floating-card {
                    transform: translateY(30px);
                    padding: 2rem;
                }
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .hero-subtitle {
                    font-size: 1.2rem;
                }

                .service-grid {
                    grid-template-columns: 1fr;
                }

                .floating-social {
                    display: none;
                }
            }

            @media (max-width: 576px) {
                .hero-content {
                    padding: 1.5rem;
                    margin: 0 1rem;
                }

                .hero-title {
                    font-size: 2rem;
                }

                .hero-subtitle {
                    font-size: 1.1rem;
                    margin-bottom: 1.5rem;
                }

                .service-content {
                    padding: 1.5rem;
                }
            }

            /* Behandelingen Styling */
            .hero-banner {
                height: 300px;
                background: var(--gradient-primary);
                border-radius: 15px;
                position: relative;
                overflow: hidden;
                margin-bottom: 2rem;
            }

            .hero-banner::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(45deg, rgba(107, 70, 193, 0.2), rgba(0, 71, 171, 0));
            }

            .luxury-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.05);
                overflow: hidden;
                border: 1px solid rgba(107, 70, 193, 0.1);
                margin-bottom: 2rem;
            }

            .card-header-luxury {
                background: var(--gradient-primary);
                padding: 1.5rem;
                border-bottom: 2px solid var(--primary-purple);
                color: white;
            }

            .treatment-card {
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                height: 100%;
                border: 1px solid rgba(107, 70, 193, 0.1);
                padding: 1.5rem;
            }

            .treatment-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 15px rgba(0,0,0,0.1);
            }

            .card-title {
                color: var(--text-color);
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            .card-text {
                color: #666;
                font-size: 0.9rem;
                line-height: 1.5;
                margin-bottom: 1rem;
            }

            .treatment-details {
                font-size: 0.9rem;
                color: #666;
                margin: 1rem 0;
            }

            .duration, .specialists {
                display: block;
                margin-bottom: 0.5rem;
                color: #666;
            }

            .price {
                font-size: 1.2rem;
                font-weight: bold;
                color: var(--primary-purple);
            }

            .badge {
                background: var(--gradient-primary);
                color: white;
                padding: 0.5em 1em;
                border-radius: 50px;
                font-weight: 500;
                font-size: 0.8rem;
            }

            .btn-gold {
                background: var(--gradient-primary);
                border: none;
                color: white;
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-gold:hover {
                background: var(--gradient-hover);
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }

            .btn-outline-gold {
                color: var(--primary-purple);
                border: 1px solid var(--primary-purple);
                background: transparent;
                padding: 0.5rem 1.5rem;
                border-radius: 50px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-outline-gold:hover {
                background: var(--gradient-primary);
                color: white;
                border-color: transparent;
            }

            /* Modal Styling */
            .luxury-modal .modal-content {
                border-radius: 15px;
                border: none;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }

            .luxury-modal .modal-header {
                background: var(--gradient-primary);
                color: white;
                border-bottom: none;
                border-radius: 15px 15px 0 0;
                padding: 1.5rem;
            }

            .luxury-modal .modal-title {
                color: white;
                font-weight: 600;
            }

            .luxury-input, .luxury-select {
                border: 1px solid rgba(107, 70, 193, 0.2);
                border-radius: 8px;
                padding: 0.75rem;
                transition: all 0.3s ease;
                font-size: 0.9rem;
            }

            .luxury-input:focus, .luxury-select:focus {
                border-color: var(--primary-purple);
                box-shadow: 0 0 0 0.2rem rgba(107, 70, 193, 0.15);
            }

            .form-label {
                color: var(--text-color);
                font-weight: 500;
                margin-bottom: 0.5rem;
            }

            .luxury-checkbox .form-check-input:checked {
                background-color: var(--primary-purple);
                border-color: var(--primary-purple);
            }

            /* Product Card Styles */
            .product-card {
                transition: transform 0.2s, box-shadow 0.2s;
                background: white;
                border: none;
            }
            
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }
            
            .product-image {
                border-radius: 8px;
                overflow: hidden;
            }
            
            .product-title {
                font-size: 1.2rem;
                font-weight: 600;
                color: #333;
            }
            
            .product-description {
                font-size: 0.9rem;
                color: #666;
                min-height: 40px;
            }
            
            .product-price {
                font-size: 1.1rem;
                color: #333;
            }
            
            .badge.bg-purple {
                background-color: #6c5ce7 !important;
                font-weight: 500;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars me-1"></i>Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-home me-2"></i>Home</a></li>
                                <li><a class="dropdown-item" href="{{ route('medewerkers.index') }}"><i class="fas fa-list me-2"></i>Behandelingen</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('medewerkers.index') }}"><i class="fas fa-cut me-2"></i>Diensten</a></li>
                                <li><a class="dropdown-item" href="#visie"><i class="fas fa-eye me-2"></i>Onze Visie</a></li>
                                <li><a class="dropdown-item" href="#contact"><i class="fas fa-envelope me-2"></i>Contact</a></li>
                            </ul>
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
