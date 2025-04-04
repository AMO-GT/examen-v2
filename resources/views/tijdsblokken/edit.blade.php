@extends('layouts.admin')

@section('content')
<style>
    .card-header.bg-primary {
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
    
    .btn-secondary {
        background: #718096;
        border: none;
    }
    
    .btn-secondary:hover {
        background: #4A5568;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(113, 128, 150, 0.3);
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tijdsblok Bewerken</h5>
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
                    
                    <form action="{{ route('tijdsblokken.update', $tijdsblok->tijdsblok_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="medewerker_id" class="form-label">Medewerker</label>
                                <select class="form-select" id="medewerker_id" name="medewerker_id" required>
                                    <option value="">Selecteer een medewerker</option>
                                    @foreach($medewerkers as $medewerker)
                                        <option value="{{ $medewerker->medewerker_id }}" {{ $tijdsblok->medewerker_id == $medewerker->medewerker_id ? 'selected' : '' }}>
                                            {{ $medewerker->naam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="datum" class="form-label">Datum</label>
                                <input type="date" class="form-control" id="datum" name="datum" value="{{ $tijdsblok->datum }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startuur" class="form-label">Starttijd</label>
                                <select class="form-select" id="startuur" name="startuur" required>
                                    @php
                                        $currentStartHour = (int)substr($tijdsblok->starttijd, 0, 2);
                                    @endphp
                                    @for ($hour = 8; $hour <= 16; $hour++)
                                        <option value="{{ $hour }}" {{ $currentStartHour == $hour ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $hour) }}:00
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="einduur" class="form-label">Eindtijd</label>
                                <select class="form-select" id="einduur" name="einduur" required>
                                    @php
                                        $currentEndHour = (int)substr($tijdsblok->eindtijd, 0, 2);
                                    @endphp
                                    @for ($hour = 9; $hour <= 17; $hour++)
                                        <option value="{{ $hour }}" {{ $currentEndHour == $hour ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $hour) }}:00
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tijdsblokken.index') }}" class="btn btn-secondary">Annuleren</a>
                            <button type="submit" class="btn btn-primary">Wijzigingen Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 