<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Vergeten - The Hair Hub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #6B46C1;
            --primary-blue: #0047AB; /* Kobaltblauw */
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
            background-color: var(--light-bg);
            min-height: 100vh;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 1rem 0;
            transition: all 0.3s ease;
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
            position: relative;
            padding: 0.5rem 1rem;
        }

        .forgot-password-container {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .section-title {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            margin-bottom: 2rem;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--gradient-primary);
            margin: 1rem 0;
            transition: width 0.3s ease;
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(107, 70, 193, 0.4);
        }

        .btn-primary:hover {
            background: var(--gradient-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 70, 193, 0.5);
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            box-shadow: none;
            border: 1px solid rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.3);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">The Hair Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('klant.login') }}">Inloggen</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="forgot-password-container">
            <h2 class="section-title">Wachtwoord Vergeten</h2>
            
            <p class="mb-4">Wachtwoord vergeten? Geen probleem. Vul je e-mailadres in en we sturen je een link om je wachtwoord opnieuw in te stellen.</p>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('klant.password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/klanten') }}" class="text-decoration-none">Terug naar inloggen</a>
                    <button type="submit" class="btn btn-primary">
                        Verstuur wachtwoord reset link
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html> 