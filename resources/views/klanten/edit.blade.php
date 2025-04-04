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

    .page-header {
        background: var(--gradient-primary);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
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
    
    .section-title.text-white {
        -webkit-text-fill-color: white;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 2rem;
    }
    
    .card .card-header {
        background: var(--primary-purple);
        color: white;
        border-bottom: none;
        padding: 1.2rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .card .card-header h5 {
        margin: 0;
        font-size: 1.25rem;
        color: white;
    }
    
    .card .card-header i {
        font-size: 1.5rem;
    }
    
    .form-label {
        font-weight: 500;
        color: var(--text-color);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(159, 122, 234, 0.25);
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
    
    .btn-secondary {
        background: #718096;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(113, 128, 150, 0.2);
    }
    
    .btn-secondary:hover {
        background: #4A5568;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(113, 128, 150, 0.3);
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="section-title text-white">Gegevens Wijzigen</h1>
        <p class="lead">Pas hier uw persoonlijke gegevens aan</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Persoonlijke Gegevens</h5>
                    <i class="fas fa-user-edit"></i>
                </div>
                
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('klant.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="naam" class="form-label">
                                    <i class="fas fa-user me-2 text-primary"></i>Naam
                                </label>
                                <input type="text" class="form-control @error('naam') is-invalid @enderror" id="naam" name="naam" value="{{ old('naam', $klant->naam) }}" required>
                                @error('naam')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $klant->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefoon" class="form-label">
                                    <i class="fas fa-phone me-2 text-primary"></i>Telefoon
                                </label>
                                <input type="text" class="form-control @error('telefoon') is-invalid @enderror" id="telefoon" name="telefoon" value="{{ old('telefoon', $klant->telefoon) }}">
                                @error('telefoon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="adres" class="form-label">
                                    <i class="fas fa-home me-2 text-primary"></i>Adres
                                </label>
                                <input type="text" class="form-control @error('adres') is-invalid @enderror" id="adres" name="adres" value="{{ old('adres', $klant->adres) }}">
                                @error('adres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="postcode" class="form-label">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>Postcode
                                </label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="postcode" name="postcode" value="{{ old('postcode', $klant->postcode) }}">
                                @error('postcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="plaats" class="form-label">
                                    <i class="fas fa-city me-2 text-primary"></i>Plaats
                                </label>
                                <input type="text" class="form-control @error('plaats') is-invalid @enderror" id="plaats" name="plaats" value="{{ old('plaats', $klant->plaats) }}">
                                @error('plaats')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="card mt-4 mb-4 p-3 bg-light">
                            <h5 class="mb-3">Wachtwoord Wijzigen (optioneel)</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>Nieuw Wachtwoord
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    <small class="form-text text-muted">Laat leeg als u uw wachtwoord niet wilt wijzigen</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>Bevestig Wachtwoord
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('klanten.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Annuleren
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Gegevens Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 