<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hair Hub - Luxe Vrouwen Kapsalon</title>
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
            position: relative;
            padding: 0.5rem 1rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .header-section {
            background-color: var(--primary-purple);
            color: white;
            padding: 12rem 0 6rem;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .header-section h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            letter-spacing: 2px;
        }

        .header-section .lead {
            font-size: 1.5rem;
            opacity: 0.9;
            letter-spacing: 1px;
        }

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

        .hero-image {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.15;
            filter: grayscale(20%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 71, 171, 0.1); /* Kobaltblauw border */
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

        .section-title:hover::after {
            width: 100px;
        }

        .vision-box {
            background-color: var(--light-bg);
            border-radius: 15px;
            padding: 3.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .vision-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .image-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.5s ease;
            height: 450px;
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .image-card:hover img {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            padding: 2.5rem;
            color: white;
            transform: translateY(100%);
            transition: transform 0.5s ease;
        }

        .image-card:hover .image-overlay {
            transform: translateY(0);
        }

        .image-overlay h3 {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .image-overlay p {
            margin-bottom: 0;
            opacity: 0.9;
            font-size: 1.1rem;
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

        .social-links a:hover {
            color: var(--primary-blue);
            transform: translateY(-3px);
        }

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

            .feature-box {
                padding: 1.5rem;
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
                gap: 1.5rem;
            }

            .floating-social {
                display: none;
            }

            .btn-primary {
                padding: 1rem 2rem;
                font-size: 0.85rem;
            }

            .d-flex.gap-4 {
                gap: 1rem !important;
            }

            .section-title {
                font-size: 2rem;
            }

            .diagonal-section {
                padding: 6rem 0;
            }

            .diagonal-section::before {
                top: -30px;
                height: 60px;
            }

            .floating-card {
                margin: 0 1rem;
            }

            .feature-box {
                margin-bottom: 1rem;
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

            .d-flex.gap-4 {
                flex-direction: column;
                gap: 1rem !important;
            }

            .btn-primary {
                width: 100%;
                text-align: center;
            }

            .service-content {
                padding: 1.5rem;
            }

            .service-item {
                height: 300px;
            }

            footer {
                padding: 3rem 0 2rem;
                clip-path: polygon(0 5%, 100% 0, 100% 100%, 0 100%);
            }

            .social-links {
                justify-content: center;
                margin-top: 1rem;
            }
        }

        /* Verbeterde touch interactie voor mobiele apparaten */
        @media (hover: none) {
            .service-item::before {
                opacity: 0.7;
            }

            .service-content {
                transform: translateY(0);
            }

            .feature-box:hover {
                transform: none;
            }

            .btn-primary:hover {
                transform: none;
            }
        }

        /* Landscape mode optimalisatie */
        @media (max-height: 600px) and (orientation: landscape) {
            .hero-section {
                min-height: 100vh;
                padding: 6rem 0;
            }

            .service-item {
                height: 250px;
            }
        }

        /* Nieuwe custom componenten en styling */
        .diagonal-section {
            position: relative;
            padding: 8rem 0;
            background: var(--light-bg);
        }

        .diagonal-section::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--light-bg);
            transform: skewY(-3deg);
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

        .feature-box:hover {
            transform: translateX(10px);
        }

        .contact-form {
            background: white;
            padding: 3rem;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 0;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-blue);
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

        @media (max-width: 768px) {
            .service-grid {
                grid-template-columns: 1fr;
            }
            
            .floating-social {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">The Hair Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Hier kunnen later menu-items worden toegevoegd -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content" data-aos="fade-right">
                        <h2 class="hero-title">The Hair Hub</h2>
                        <p class="hero-subtitle">In onze exclusieve salon draait alles om jou. Of je nu een stijlvolle kleur of gewoon een moment van pure verwennerij. wij zorgen ervoor dat jij stralend de deur uitgaat.</p>
                        <div class="d-flex gap-4">
                            <a href="#contact" class="btn btn-primary btn-lg">Maak een afspraak</a>
                            <a href="#diensten" class="btn btn-primary btn-lg">Ontdek onze diensten</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visie Section -->
    <section class="py-5" id="visie">
        <div class="container">
            <h2 class="section-title text-center" data-aos="fade-up">Onze Visie</h2>
            <div class="vision-box" data-aos="fade-up" data-aos-delay="200">
                <p class="mb-0">Bij The Hair Hub geloven we dat elk persoon uniek is en een eigen stijl verdient. Onze visie is om vrouwen te helpen hun natuurlijke schoonheid te ontdekken en te versterken door middel van professionele haarverzorging en styling. We streven ernaar om een warme, uitnodigende omgeving te creëren waar klanten zich thuis voelen en met vertrouwen hun haarwensen kunnen delen.</p>
            </div>
        </div>
    </section>

    <!-- Floating Social Links -->
    <div class="floating-social d-none d-lg-flex">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-pinterest-p"></i></a>
    </div>

    <!-- Diensten Section met nieuwe styling -->
    <section class="diagonal-section" id="diensten">
        <div class="container">
            <div class="floating-card">
                <h2 class="section-title text-center" data-aos="fade-up">Onze Expertise</h2>
                <div class="service-grid">
                    <div class="service-item" data-aos="fade-up" data-aos-delay="200" style="background: url('https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;">
                        <div class="service-content">
                            <h3>Knippen & Styling</h3>
                            <p>Vakkundige kniptechnieken en styling op maat</p>
                            <a href="#contact" class="btn btn-outline-light mt-3">Reserveer Nu</a>
                        </div>
                    </div>
                    <div class="service-item" data-aos="fade-up" data-aos-delay="400" style="background: url('https://images.unsplash.com/photo-1595475884562-073c30d45670?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;">
                        <div class="service-content">
                            <h3>Kleuring</h3>
                            <p>Professionele kleurbehandelingen</p>
                            <a href="#contact" class="btn btn-outline-light mt-3">Reserveer Nu</a>
                        </div>
                    </div>
                    <div class="service-item" data-aos="fade-up" data-aos-delay="600" style="background: url('https://images.unsplash.com/photo-1595475884562-073c30d45670?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;">
                        <div class="service-content">
                            <h3>Behandelingen</h3>
                            <p>Luxe haar- en hoofdhuidbehandelingen</p>
                            <a href="#contact" class="btn btn-outline-light mt-3">Reserveer Nu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-right">
                    <div class="feature-box">
                        <i class="fas fa-award mb-4" style="font-size: 2rem; color: var(--primary-purple);"></i>
                        <h3 class="h5 mb-3">Expertise</h3>
                        <p class="mb-0">Jarenlange ervaring in het vak met continue bijscholing</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="feature-box">
                        <i class="fas fa-heart mb-4" style="font-size: 2rem; color: var(--primary-purple);"></i>
                        <h3 class="h5 mb-3">Persoonlijke Aandacht</h3>
                        <p class="mb-0">Individueel advies en behandeling op maat</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-left">
                    <div class="feature-box">
                        <i class="fas fa-gem mb-4" style="font-size: 2rem; color: var(--primary-purple);"></i>
                        <h3 class="h5 mb-3">Luxe Ervaring</h3>
                        <p class="mb-0">Premium producten en een ontspannen sfeer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <h3 class="h5 mb-4">Contact</h3>
                    <p class="mb-2">Email: info@thehairhub.nl</p>
                    <p class="mb-2">Tel: 020-1234567</p>
                    <p class="mb-0">Adres: Voorbeeldstraat 123</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="h5 mb-4">Openingstijden</h3>
                    <p class="mb-2">Maandag - Vrijdag: 09:00 - 18:00</p>
                    <p class="mb-2">Zaterdag: 09:00 - 17:00</p>
                    <p class="mb-0">Zondag: Gesloten</p>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="h5 mb-4">Volg Ons</h3>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-light">
            <div class="text-center">
                <p class="mb-0">© 2024 The Hair Hub - Alle rechten voorbehouden</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

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
