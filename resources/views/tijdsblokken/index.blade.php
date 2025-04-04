@extends('layouts.app')

@section('content')
<style>
    .card-header.bg-primary {
        background: var(--gradient-primary) !important;
    }
    
    .card-header.bg-success {
        background: linear-gradient(135deg, #38A169, #2F855A) !important;
    }
    
    .badge.bg-primary {
        background: var(--gradient-primary) !important;
    }
    
    .btn-primary {
        background: var(--gradient-primary);
        border: none;
    }
    
    .btn-primary:hover {
        background: var(--gradient-hover);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(107, 70, 193, 0.3);
    }
    
    .alert-info {
        background-color: rgba(107, 70, 193, 0.1);
        border-color: rgba(107, 70, 193, 0.2);
        color: var(--primary-purple);
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: none;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="mb-4" style="color: var(--primary-purple);">Tijdsblokken Beheren</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Formulier voor nieuw tijdsblok -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Nieuw Tijdsblok Toevoegen</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tijdsblokken.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="medewerker_id" class="form-label">Medewerker</label>
                                <select class="form-select" id="medewerker_id" name="medewerker_id" required>
                                    <option value="">Selecteer een medewerker</option>
                                    @foreach($medewerkers as $medewerker)
                                        <option value="{{ $medewerker->medewerker_id }}">{{ $medewerker->naam }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="datum" class="form-label">Datum</label>
                                <input type="date" class="form-control" id="datum" name="datum" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startuur" class="form-label">Starttijd</label>
                                <select class="form-select" id="startuur" name="startuur" required>
                                    @for ($hour = 8; $hour <= 16; $hour++)
                                        <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}:00</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="einduur" class="form-label">Eindtijd</label>
                                <select class="form-select" id="einduur" name="einduur" required>
                                    @for ($hour = 9; $hour <= 17; $hour++)
                                        <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}:00</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Tijdsblok Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Overzicht van tijdsblokken voor vandaag -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tijdsblokken van Vandaag</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Medewerker</th>
                                    <th>Starttijd</th>
                                    <th>Eindtijd</th>
                                    <th>Duur</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $vandaag = \Carbon\Carbon::today()->format('Y-m-d');
                                    $tijdsblokkenvandaag = $tijdsblokken->where('datum', $vandaag);
                                @endphp

                                @forelse($tijdsblokkenvandaag as $tijdsblok)
                                    <tr>
                                        <td>{{ $tijdsblok->medewerker->naam }}</td>
                                        <td>{{ substr($tijdsblok->starttijd, 0, 5) }}</td>
                                        <td>{{ substr($tijdsblok->eindtijd, 0, 5) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tijdsblok->starttijd)->diffInHours(\Carbon\Carbon::parse($tijdsblok->eindtijd)) }} uur</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('tijdsblokken.edit', $tijdsblok->tijdsblok_id) }}" class="btn btn-sm btn-primary">Bewerken</a>
                                                <form action="{{ route('tijdsblokken.destroy', $tijdsblok->tijdsblok_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit tijdsblok wilt verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Verwijderen</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Geen tijdsblokken voor vandaag</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Alle tijdsblokken tabel met filters -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Alle Tijdsblokken</h5>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form action="{{ route('tijdsblokken.index') }}" method="GET" class="mb-4">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="filter_medewerker" class="form-label">Filter op Medewerker</label>
                                <select class="form-select" id="filter_medewerker" name="filter_medewerker">
                                    <option value="">Alle medewerkers</option>
                                    @foreach($medewerkers as $medewerker)
                                        <option value="{{ $medewerker->medewerker_id }}" {{ request('filter_medewerker') == $medewerker->medewerker_id ? 'selected' : '' }}>
                                            {{ $medewerker->naam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="filter_datum" class="form-label">Filter op Datum</label>
                                <input type="date" class="form-control" id="filter_datum" name="filter_datum" value="{{ request('filter_datum') }}">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <div class="d-grid gap-2 w-100">
                                    <button type="submit" class="btn btn-primary">Filteren</button>
                                    <a href="{{ route('tijdsblokken.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Snelle filters -->
                        <div class="d-flex gap-2 mb-3">
                            <a href="{{ route('tijdsblokken.index', ['filter_periode' => 'huidige_maand']) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-alt"></i> Huidige Maand
                            </a>
                            <a href="{{ route('tijdsblokken.index', ['filter_periode' => 'vorige_maand']) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-minus"></i> Vorige Maand
                            </a>
                            <a href="{{ route('tijdsblokken.index', ['filter_periode' => 'deze_week']) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-week"></i> Deze Week
                            </a>
                        </div>
                    </form>
                    
                    @if(request('filter_medewerker') || request('filter_datum') || request('filter_periode'))
                        <div class="alert alert-info mb-4">
                            <h6 class="mb-2">Actieve filters:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @if(request('filter_medewerker'))
                                    <div class="badge bg-primary p-2">
                                        Medewerker: {{ $medewerkers->where('medewerker_id', request('filter_medewerker'))->first()->naam ?? 'Onbekend' }}
                                    </div>
                                @endif
                                
                                @if(request('filter_datum'))
                                    <div class="badge bg-primary p-2">
                                        Datum: {{ \Carbon\Carbon::parse(request('filter_datum'))->format('d-m-Y') }}
                                    </div>
                                @endif
                                
                                @if(request('filter_periode') == 'huidige_maand')
                                    <div class="badge bg-primary p-2">
                                        Periode: Huidige maand
                                    </div>
                                @elseif(request('filter_periode') == 'vorige_maand')
                                    <div class="badge bg-primary p-2">
                                        Periode: Vorige maand
                                    </div>
                                @elseif(request('filter_periode') == 'deze_week')
                                    <div class="badge bg-primary p-2">
                                        Periode: Deze week
                                    </div>
                                @endif
                                
                                <a href="{{ route('tijdsblokken.index') }}" class="badge bg-secondary p-2 text-decoration-none">
                                    Filters wissen
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Tabel met alle tijdsblokken -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Medewerker</th>
                                    <th>Datum</th>
                                    <th>Starttijd</th>
                                    <th>Eindtijd</th>
                                    <th>Duur</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tijdsblokken as $tijdsblok)
                                    <tr>
                                        <td>{{ $tijdsblok->medewerker->naam }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tijdsblok->datum)->format('d-m-Y') }}</td>
                                        <td>{{ substr($tijdsblok->starttijd, 0, 5) }}</td>
                                        <td>{{ substr($tijdsblok->eindtijd, 0, 5) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tijdsblok->starttijd)->diffInHours(\Carbon\Carbon::parse($tijdsblok->eindtijd)) }} uur</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('tijdsblokken.edit', $tijdsblok->tijdsblok_id) }}" class="btn btn-sm btn-primary">Bewerken</a>
                                                <form action="{{ route('tijdsblokken.destroy', $tijdsblok->tijdsblok_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit tijdsblok wilt verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Verwijderen</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Geen tijdsblokken gevonden</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
