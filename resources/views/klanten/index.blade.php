@extends('layouts.app')

@section('content')
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

    .section-title {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
        margin-bottom: 2rem;
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
        margin: 1rem 0;
        transition: width 0.3s ease;
    }

    .section-title:hover::after {
        width: 100px;
    }
    
    .customer-card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 2rem;
        height: 100%;
    }
    
    .customer-card:hover {
        transform: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    
    .customer-card .card-header {
        background: var(--gradient-primary);
        color: white;
        border-bottom: none;
        padding: 1.2rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .customer-card .card-header h5 {
        margin: 0;
        font-size: 1.25rem;
        color: white;
    }
    
    .customer-card .card-header i {
        font-size: 1.5rem;
    }

    .btn-primary {
        background: var(--gradient-primary);
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(107, 70, 193, 0.2);
    }

    .btn-primary:hover {
        background: var(--gradient-hover);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(107, 70, 193, 0.3);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #e53e3e, #c53030);
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(229, 62, 62, 0.2);
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #c53030, #e53e3e);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(229, 62, 62, 0.3);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #48bb78, #38a169);
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(72, 187, 120, 0.2);
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #38a169, #48bb78);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(72, 187, 120, 0.3);
    }
    
    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .badge.bg-primary {
        background: var(--gradient-primary) !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(159, 122, 234, 0.25);
    }
    
    .welcome-banner {
        background: var(--gradient-primary);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table thead th {
        background: var(--primary-purple);
        color: white;
        font-weight: 600;
        border: none;
    }
    
    .appointment-form {
        background-color: var(--light-bg);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-top: 2rem;
    }
    
    .page-header {
        background: var(--gradient-primary);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.2rem;
        padding-bottom: 1.2rem;
        border-bottom: 1px solid #edf2f7;
    }
    
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .info-item i {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--light-bg);
        color: var(--primary-purple);
        margin-right: 1rem;
        font-size: 1.2rem;
    }
    
    .info-item .info-content {
        flex: 1;
    }
    
    .info-item .info-content strong {
        display: block;
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 0.3rem;
    }
    
    .info-item .info-content span {
        font-size: 1.1rem;
        color: var(--text-color);
        font-weight: 500;
    }
    
    .dashboard-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .dashboard-actions .btn {
        flex: 1;
        min-width: 150px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .dashboard-actions .btn i {
        margin-right: 0.5rem;
    }
    
    .sticky-sidebar {
        position: sticky;
        top: 20px;
    }
    
    @media (max-width: 991.98px) {
        .sticky-sidebar {
            position: static;
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="section-title text-white" style="-webkit-text-fill-color: white;">Klanten Portaal</h1>
        <p class="lead">Uw persoonlijke omgeving bij The Hair Hub</p>
    </div>
</div>

<div class="container">
    @if($isAuthenticated)
        <!-- Welkomstbericht voor ingelogde gebruikers -->
        <div class="welcome-banner">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3>Welkom, {{ $klant->naam }}!</h3>
                    <p class="mb-0">U bent succesvol ingelogd als klant. Hier kunt u uw gegevens bekijken en afspraken beheren.</p>
                </div>
                <div class="d-none d-md-block">
                    <i class="fas fa-user-circle fa-3x"></i>
                </div>
            </div>
        </div>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row">
            <!-- Linker kolom: Klant informatie -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="sticky-sidebar">
                    <!-- Klant informatie -->
                    <div class="customer-card card">
                        <div class="card-header">
                            <h5 class="mb-0">Uw Gegevens</h5>
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <div class="info-content">
                                    <strong>Naam</strong>
                                    <span>{{ $klant->naam }}</span>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div class="info-content">
                                    <strong>Email</strong>
                                    <span>{{ $klant->email }}</span>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div class="info-content">
                                    <strong>Telefoon</strong>
                                    <span>{{ $klant->telefoon ?? 'Niet opgegeven' }}</span>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-home"></i>
                                <div class="info-content">
                                    <strong>Adres</strong>
                                    <span>{{ $klant->adres ?? 'Niet opgegeven' }}</span>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="info-content">
                                    <strong>Postcode & Plaats</strong>
                                    <span>{{ ($klant->postcode ?? 'Niet opgegeven') . ' ' . ($klant->plaats ?? '') }}</span>
                                </div>
                            </div>
                            
                            <div class="dashboard-actions">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Wijzig gegevens
                                </a>
                                
                                <form method="POST" action="{{ route('klant.logout') }}" class="flex-grow-1">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="fas fa-sign-out-alt"></i> Uitloggen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Rechter kolom: Afspraken -->
            <div class="col-lg-8">
                <!-- Afspraken Sectie -->
                <div class="customer-card card">
                    <div class="card-header">
                        <h5 class="mb-0">Uw Afspraken</h5>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-body">
                        @if($klant->reserveringen->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Datum</th>
                                            <th>Tijd</th>
                                            <th>Medewerker</th>
                                            <th>Behandelingen</th>
                                            <th>Acties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($klant->reserveringen as $reservering)
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($reservering->datum)) }}</td>
                                                <td>{{ date('H:00', strtotime($reservering->tijd)) }}</td>
                                                <td>{{ $reservering->medewerker->naam }}</td>
                                                <td>
                                                    @foreach($reservering->behandelingen as $behandeling)
                                                        <span class="badge bg-primary">{{ $behandeling->naam }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('reserveringen.destroy', $reservering->reservering_id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet u zeker dat u deze afspraak wilt annuleren?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('reserveringen.edit', $reservering->reservering_id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3"></i>
                                    <p class="mb-0">U heeft nog geen afspraken gepland. Maak hieronder uw eerste afspraak!</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="appointment-form">
                            <h4 class="mb-4" style="color: var(--primary-purple);">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Nieuwe Afspraak Maken
                            </h4>
                            <form action="{{ route('reserveringen.store') }}" method="POST" id="afspraakForm">
                                @csrf
                                <input type="hidden" name="klant_id" value="{{ $klant->klant_id }}">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="datum" class="form-label">
                                            <i class="fas fa-calendar me-2 text-primary"></i>Datum
                                        </label>
                                        <input type="date" class="form-control @error('datum') is-invalid @enderror" id="datum" name="datum" required min="{{ date('Y-m-d') }}">
                                        @error('datum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-6 mb-3">
                                        <label for="medewerker_id" class="form-label">
                                            <i class="fas fa-user-md me-2 text-primary"></i>Medewerker
                                        </label>
                                        <select class="form-select @error('medewerker_id') is-invalid @enderror" id="medewerker_id" name="medewerker_id" required disabled>
                                            <option value="">Selecteer eerst een datum</option>
                                        </select>
                                        <small class="form-text text-muted">De beschikbare medewerkers zijn afhankelijk van de gekozen dag.</small>
                                        @error('medewerker_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tijd" class="form-label">
                                        <i class="fas fa-clock me-2 text-primary"></i>Tijd
                                    </label>
                                    <select class="form-select @error('tijd') is-invalid @enderror" id="tijd" name="tijd" required disabled>
                                        <option value="">Selecteer eerst een medewerker</option>
                                    </select>
                                    <small class="form-text text-muted">Afspraken zijn per uur beschikbaar.</small>
                                    @error('tijd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="behandelingen" class="form-label">
                                        <i class="fas fa-cut me-2 text-primary"></i>Behandelingen
                                    </label>
                                    <div id="behandelingenContainer" class="card p-3 bg-white border-0 shadow-sm">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Selecteer eerst een medewerker om beschikbare behandelingen te zien.
                                        </div>
                                    </div>
                                    @error('behandelingen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check me-2"></i>Afspraak Maken
                                    </button>
                                </div>
                            </form>
                        </div>
                            
                        <!-- Javascript voor dynamische medewerkers en tijden -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const datumInput = document.getElementById('datum');
                            const medewerkerSelect = document.getElementById('medewerker_id');
                            const tijdSelect = document.getElementById('tijd');
                            const behandelingenContainer = document.getElementById('behandelingenContainer');
                            
                            // Wanneer de datum verandert
                            datumInput.addEventListener('change', function() {
                                // Reset de medewerker en tijd selects
                                medewerkerSelect.innerHTML = '<option value="">Selecteer een medewerker</option>';
                                tijdSelect.innerHTML = '<option value="">Selecteer eerst een medewerker</option>';
                                tijdSelect.disabled = true;
                                
                                // Reset behandelingen container
                                behandelingenContainer.innerHTML = `
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Selecteer eerst een medewerker om beschikbare behandelingen te zien.
                                    </div>
                                `;
                                
                                const selectedDate = new Date(this.value);
                                if (selectedDate) {
                                    // Get the day of week (0 = Sunday, 1 = Monday, etc.)
                                    const dayOfWeek = selectedDate.getDay();
                                    
                                    // Fetch available medewerkers for this day
                                    fetch(`/api/available-medewerkers/${dayOfWeek}`)
                                        .then(response => {
                                            console.log('Medewerkers response:', response);
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Medewerkers data:', data);
                                            // Enable the medewerker select
                                            medewerkerSelect.disabled = false;
                                            
                                            // Store the medewerkers data for later use
                                            window.medewerkerData = data;
                                            
                                            // Add the medewerkers as options
                                            if (data.length > 0) {
                                                data.forEach(medewerker => {
                                                    const option = document.createElement('option');
                                                    option.value = medewerker.medewerker_id;
                                                    option.textContent = medewerker.naam;
                                                    medewerkerSelect.appendChild(option);
                                                });
                                            } else {
                                                medewerkerSelect.innerHTML = '<option value="">Geen medewerkers beschikbaar op deze dag</option>';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error fetching medewerkers:', error);
                                        });
                                }
                            });
                            
                            // Wanneer de medewerker verandert
                            medewerkerSelect.addEventListener('change', function() {
                                // Reset de tijd select
                                tijdSelect.innerHTML = '<option value="">Selecteer een tijd</option>';
                                
                                // Toon de behandelingen van de geselecteerde medewerker
                                if (this.value && window.medewerkerData) {
                                    const medewerkerId = parseInt(this.value);
                                    const medewerker = window.medewerkerData.find(m => m.medewerker_id === medewerkerId);
                                    
                                    if (medewerker && medewerker.behandelingen) {
                                        // Update de behandelingen container
                                        let html = '<div class="row">';
                                        
                                        if (medewerker.behandelingen.length > 0) {
                                            medewerker.behandelingen.forEach(behandeling => {
                                                html += `
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-check d-flex align-items-center">
                                                            <input class="form-check-input me-2" type="checkbox" name="behandelingen[]" value="${behandeling.behandeling_id}" id="behandeling_${behandeling.behandeling_id}">
                                                            <label class="form-check-label d-flex justify-content-between w-100" for="behandeling_${behandeling.behandeling_id}">
                                                                <span>${behandeling.naam}</span>
                                                                <span class="badge bg-primary">€${parseFloat(behandeling.prijs).toFixed(2)}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                `;
                                            });
                                        } else {
                                            html += `
                                                <div class="col-12">
                                                    <div class="alert alert-warning">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                                        Deze medewerker heeft geen beschikbare behandelingen.
                                                    </div>
                                                </div>
                                            `;
                                        }
                                        
                                        html += '</div>';
                                        behandelingenContainer.innerHTML = html;
                                    }
                                    
                                    // Let's also remove the old medewerker-behandelingen container if it exists
                                    const oldBehandelingenContainer = document.getElementById('medewerker-behandelingen');
                                    if (oldBehandelingenContainer) {
                                        oldBehandelingenContainer.remove();
                                    }
                                } else {
                                    // Als er geen medewerker is geselecteerd, reset behandelingen container
                                    behandelingenContainer.innerHTML = `
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Selecteer eerst een medewerker om beschikbare behandelingen te zien.
                                        </div>
                                    `;
                                }
                                
                                if (this.value) {
                                    const medewerkerId = this.value;
                                    const selectedDate = datumInput.value;
                                    
                                    // Fetch available times for this medewerker on this date
                                    fetch(`/api/available-times/${medewerkerId}/${selectedDate}`)
                                        .then(response => {
                                            console.log('Times response:', response);
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log('Times data:', data);
                                            // Enable the tijd select
                                            tijdSelect.disabled = false;
                                            
                                            // Add the times as options
                                            if (data.length > 0) {
                                                data.forEach(time => {
                                                    const option = document.createElement('option');
                                                    option.value = time;
                                                    
                                                    // Format the time for display (e.g., "09:00")
                                                    const timeParts = time.split(':');
                                                    option.textContent = `${timeParts[0]}:${timeParts[1]}`;
                                                    
                                                    tijdSelect.appendChild(option);
                                                });
                                            } else {
                                                tijdSelect.innerHTML = '<option value="">Geen tijden beschikbaar</option>';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error fetching times:', error);
                                        });
                                } else {
                                    tijdSelect.disabled = true;
                                }
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Welkomstbericht voor niet-ingelogde gebruikers -->
        <div class="welcome-banner">
            <h3>Welkom bij The Hair Hub</h3>
            <p class="mb-0">Log in of maak een account aan om afspraken te maken en uw persoonlijke klantgegevens te beheren.</p>
        </div>
        
        <!-- Login/Register Tabs -->
        <div class="customer-card card">
            <div class="card-body">
                <ul class="nav nav-tabs mb-4" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Inloggen</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Registreren</button>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content" id="authTabsContent">
                    <!-- Login Form -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form method="POST" action="{{ route('klant.login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="login-email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="login-password" class="form-label">Wachtwoord</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="login-password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Onthoud mij</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Inloggen</button>
                        </form>
                    </div>
                    
                    <!-- Register Form -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form method="POST" action="{{ route('klant.register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="register-naam" class="form-label">Naam</label>
                                <input type="text" class="form-control @error('naam') is-invalid @enderror" id="register-naam" name="naam" value="{{ old('naam') }}" required autofocus>
                                @error('naam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-telefoon" class="form-label">Telefoon</label>
                                <input type="text" class="form-control @error('telefoon') is-invalid @enderror" id="register-telefoon" name="telefoon" value="{{ old('telefoon') }}">
                                @error('telefoon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-adres" class="form-label">Adres</label>
                                <input type="text" class="form-control @error('adres') is-invalid @enderror" id="register-adres" name="adres" value="{{ old('adres') }}">
                                @error('adres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-postcode" class="form-label">Postcode</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="register-postcode" name="postcode" value="{{ old('postcode') }}">
                                @error('postcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-plaats" class="form-label">Plaats</label>
                                <input type="text" class="form-control @error('plaats') is-invalid @enderror" id="register-plaats" name="plaats" value="{{ old('plaats') }}">
                                @error('plaats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Wachtwoord</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="register-password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="register-password_confirmation" class="form-label">Bevestig Wachtwoord</label>
                                <input type="password" class="form-control" id="register-password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registreren</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection


