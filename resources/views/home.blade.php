@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content" data-aos="fade-right">
                    <h2 class="hero-title">The Hair Hub</h2>
                    <p class="hero-subtitle">In onze exclusieve salon draait alles om jou. Of je nu een stijlvolle kleur of gewoon een moment van pure verwennerij. wij zorgen ervoor dat jij stralend de deur uitgaat.</p>
                    <div class="d-flex gap-4">
                        <a href="{{ route('klanten.index') }}" class="btn btn-primary btn-lg">Maak een afspraak</a>
                        <a href="{{ route('medewerkers.index') }}" class="btn btn-primary btn-lg">Ontdek onze diensten</a>
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

<!-- Contact Section -->
<section id="contact" class="py-5">
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
    </div>
</section>
@endsection
