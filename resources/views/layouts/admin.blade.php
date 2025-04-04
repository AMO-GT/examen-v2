<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

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
            --sidebar-width: 250px;
            --gradient-primary: linear-gradient(135deg, #6B46C1, #0047AB);
            --gradient-hover: linear-gradient(135deg, #0047AB, #6B46C1);
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Sidebar stijlen */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: white;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem;
            background: var(--gradient-primary);
        }

        .sidebar-header h3 {
            color: white;
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            padding: 1rem 0;
            list-style: none;
        }

        .sidebar-menu-item {
            padding: 0;
        }

        .sidebar-menu-link {
            display: block;
            padding: 0.75rem 1.5rem;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 500;
        }

        .sidebar-menu-link:hover {
            background-color: var(--light-bg);
            color: var(--primary-purple);
        }

        .sidebar-menu-link.active {
            color: var(--primary-purple);
            background-color: var(--light-bg);
            font-weight: 600;
            border-left: 4px solid var(--primary-purple);
        }

        .sidebar-menu-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main content area */
        .admin-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Cards en componenten stijlen */
        .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: none;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .card-header.bg-primary {
            background: var(--gradient-primary) !important;
        }
        
        .card-header.bg-success {
            background: linear-gradient(135deg, #38A169, #2F855A) !important;
        }

        /* Buttons stijlen */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--gradient-hover);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(107, 70, 193, 0.3);
        }

        .btn-secondary {
            background: #718096;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4A5568;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(113, 128, 150, 0.3);
        }

        /* User profile dropdown in sidebar */
        .user-profile {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
        }
        
        .user-profile-link {
            display: flex;
            align-items: center;
            color: var(--text-color);
            text-decoration: none;
        }
        
        .user-profile-link:hover {
            color: var(--primary-purple);
        }
        
        .user-profile-link img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .user-dropdown {
            padding: 0;
            list-style: none;
            margin-top: 10px;
            display: none;
        }
        
        .user-dropdown.show {
            display: block;
        }
        
        .user-dropdown-item {
            padding: 0.5rem 0;
        }
        
        .user-dropdown-link {
            color: var(--text-color);
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
        }
        
        .user-dropdown-link:hover {
            color: var(--primary-purple);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
            }
            
            .sidebar.active {
                margin-left: 0;
            }
            
            .admin-content {
                margin-left: 0;
                width: 100%;
            }
            
            .admin-content.active {
                margin-left: var(--sidebar-width);
            }
            
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                background: var(--primary-purple);
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                text-align: center;
                line-height: 40px;
                z-index: 1001;
                cursor: pointer;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        }
        
        /* Tabel stijlen */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table th {
            background-color: rgba(107, 70, 193, 0.1);
            color: var(--primary-purple);
            font-weight: 600;
        }
        
        .table tr:hover {
            background-color: rgba(107, 70, 193, 0.05);
        }
        
        /* Badge stijlen */
        .badge.bg-primary {
            background: var(--gradient-primary) !important;
        }
        
        /* Alert stijlen */
        .alert-info {
            background-color: rgba(107, 70, 193, 0.1);
            border-color: rgba(107, 70, 193, 0.2);
            color: var(--primary-purple);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Sidebar toggle voor mobiel -->
    <div class="sidebar-toggle d-md-none">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>The Hair Hub</h3>
        </div>
        
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="{{ route('beheerders.index') }}" class="sidebar-menu-link {{ request()->routeIs('beheerders.index') ? 'active' : '' }}">
                    <i class="fas fa-cut"></i> Kappers
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ route('tijdsblokken.index') }}" class="sidebar-menu-link {{ request()->routeIs('tijdsblokken.*') ? 'active' : '' }}">
                    <i class="far fa-clock"></i> Tijdsblokken
                </a>
            </li>
            <!-- Rapportage menu items -->
            <li class="sidebar-menu-item">
                <a href="#rapportageMenu" class="sidebar-menu-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false">
                    <span><i class="fas fa-chart-bar"></i> Rapportages</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="collapse list-unstyled ms-4" id="rapportageMenu">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('rapportage.uren-overzicht') }}" class="sidebar-menu-link {{ request()->routeIs('rapportage.uren-overzicht') ? 'active' : '' }}">
                            <i class="fas fa-clock"></i> Uren Overzicht
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <!-- User profiel -->
        @auth
        <div class="user-profile">
            <a href="#userDropdown" class="user-profile-link" data-bs-toggle="collapse">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}">
                <div>
                    <div>{{ Auth::user()->name }}</div>
                    <small class="text-muted">Administrator</small>
                </div>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            
            <ul class="collapse" id="userDropdown">
                <li class="user-dropdown-item">
                    <a href="{{ route('profile.edit') }}" class="user-dropdown-link">
                        <i class="fas fa-user me-2"></i> Profiel
                    </a>
                </li>
                <li class="user-dropdown-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="user-dropdown-link border-0 bg-transparent w-100 text-start">
                            <i class="fas fa-sign-out-alt me-2"></i> Uitloggen
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        // Mobile sidebar toggle
        document.querySelector('.sidebar-toggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.admin-content').classList.toggle('active');
        });
    </script>
    
    @yield('scripts')
</body>
</html> 