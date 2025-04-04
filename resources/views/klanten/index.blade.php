@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="mb-0">Klanten Overzicht</h2>
                </div>
                <div class="card-body">
                    @if($isAuthenticated)
                        <!-- Welkomstbericht voor ingelogde gebruikers -->
                        <div class="alert alert-success">
                            <h4>Welkom, {{ $klant->naam }}!</h4>
                            <p>U bent succesvol ingelogd als klant.</p>
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
                        
                        <!-- Klant informatie -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Uw Gegevens</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Naam:</strong> {{ $klant->naam }}</p>
                                        <p><strong>Email:</strong> {{ $klant->email }}</p>
                                        <p><strong>Telefoon:</strong> {{ $klant->telefoon ?? 'Niet opgegeven' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Adres:</strong> {{ $klant->adres ?? 'Niet opgegeven' }}</p>
                                        <p><strong>Postcode:</strong> {{ $klant->postcode ?? 'Niet opgegeven' }}</p>
                                        <p><strong>Plaats:</strong> {{ $klant->plaats ?? 'Niet opgegeven' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Afspraken Sectie -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Uw Afspraken</h5>
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
                                                            <form action="{{ route('reserveringen.destroy', $reservering->reservering_id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Weet u zeker dat u deze afspraak wilt annuleren?')">Annuleren</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>U heeft nog geen afspraken gepland.</p>
                                @endif
                                
                                <hr><br>
                                <h5>Nieuwe Afspraak Maken</h5>
                                <form action="{{ route('reserveringen.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="klant_id" value="{{ $klant->klant_id }}">
                                    
                                    <div class="mb-3">
                                        <label for="datum" class="form-label">Datum</label>
                                        <input type="date" class="form-control @error('datum') is-invalid @enderror" id="datum" name="datum" required min="{{ date('Y-m-d') }}">
                                        @error('datum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="tijd" class="form-label">Tijd</label>
                                        <select class="form-select @error('tijd') is-invalid @enderror" id="tijd" name="tijd" required>
                                            <option value="">Kies een tijd</option>
                                            <option value="09:00:00">09:00</option>
                                            <option value="10:00:00">10:00</option>
                                            <option value="11:00:00">11:00</option>
                                            <option value="12:00:00">12:00</option>
                                            <option value="13:00:00">13:00</option>
                                            <option value="14:00:00">14:00</option>
                                            <option value="15:00:00">15:00</option>
                                            <option value="16:00:00">16:00</option>
                                            <option value="17:00:00">17:00</option>
                                        </select>
                                        <small class="form-text text-muted">Afspraken zijn per uur beschikbaar.</small>
                                        @error('tijd')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="medewerker_id" class="form-label">Medewerker</label>
                                        <select class="form-select @error('medewerker_id') is-invalid @enderror" id="medewerker_id" name="medewerker_id" required>
                                            <option value="">Kies een medewerker</option>
                                            @foreach($medewerkers as $medewerker)
                                                <option value="{{ $medewerker->medewerker_id }}">{{ $medewerker->naam }}</option>
                                            @endforeach
                                        </select>
                                        @error('medewerker_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="behandelingen" class="form-label">Behandelingen</label>
                                        <div class="form-check">
                                            @foreach($behandelingen as $behandeling)
                                                <div class="mb-1">
                                                    <input class="form-check-input" type="checkbox" name="behandelingen[]" value="{{ $behandeling->behandeling_id }}" id="behandeling_{{ $behandeling->behandeling_id }}">
                                                    <label class="form-check-label" for="behandeling_{{ $behandeling->behandeling_id }}">
                                                        {{ $behandeling->naam }} (€{{ number_format($behandeling->prijs, 2) }})
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('behandelingen')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success">Afspraak Maken</button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Uitlog knop -->
                        <form method="POST" action="{{ route('klant.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Uitloggen</button>
                        </form>
                    @else
                        <!-- Welkomstbericht voor niet-ingelogde gebruikers -->
                        <p>Welkom op de klanten pagina! Log in of maak een account aan om afspraken te maken.</p>
                        
                        <!-- Login/Register Tabs -->
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
                                    <div class="mb-3">
                                        <label for="register-password_confirmation" class="form-label">Bevestig Wachtwoord</label>
                                        <input type="password" class="form-control" id="register-password_confirmation" name="password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Registreren</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


