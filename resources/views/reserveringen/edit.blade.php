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
    }
    
    .customer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background: var(--gradient-primary);
        color: white;
        border-bottom: none;
        padding: 1.2rem 1.5rem;
        font-weight: 600;
    }
    
    .card-header h2, .card-header h5 {
        margin: 0;
        color: white;
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
        background: linear-gradient(135deg, #718096, #4A5568);
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(74, 85, 104, 0.2);
    }
    
    .btn-secondary:hover {
        background: linear-gradient(135deg, #4A5568, #718096);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(74, 85, 104, 0.3);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(159, 122, 234, 0.25);
    }
    
    .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
    }
    
    .badge.bg-primary {
        background: var(--gradient-primary) !important;
    }
    
    .page-header {
        background: var(--gradient-primary);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }
    
    .list-group-item {
        border-radius: 10px;
        margin-bottom: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .form-text {
        color: #718096;
    }
    
    .appointment-form {
        background-color: var(--light-bg);
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="page-header">
    <div class="container">
        <h1 class="section-title text-white" style="-webkit-text-fill-color: white;">Afspraak Wijzigen</h1>
        <p class="lead">Pas uw afspraak aan voor The Hair Hub</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
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
            
            <div class="customer-card card">
                <div class="card-body appointment-form">
                    <h4 class="mb-4" style="color: var(--primary-purple);">Afspraak Details Aanpassen</h4>
                    
                    <form action="{{ route('reserveringen.update', $reservering->reservering_id) }}" method="POST" id="editAfspraakForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="datum" class="form-label">Datum</label>
                            <input type="date" class="form-control @error('datum') is-invalid @enderror" id="datum" name="datum" value="{{ old('datum', $reservering->datum) }}" required min="{{ date('Y-m-d') }}">
                            @error('datum')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="medewerker_id" class="form-label">Medewerker</label>
                            <select class="form-select @error('medewerker_id') is-invalid @enderror" id="medewerker_id" name="medewerker_id" required>
                                <option value="">Selecteer een medewerker</option>
                                @foreach($medewerkers as $medewerker)
                                    <option value="{{ $medewerker->medewerker_id }}" {{ (old('medewerker_id', $reservering->medewerker_id) == $medewerker->medewerker_id) ? 'selected' : '' }}>
                                        {{ $medewerker->naam }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Opmerking: Na het wijzigen van de datum worden alleen beschikbare medewerkers getoond.</small>
                            @error('medewerker_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="tijd" class="form-label">Tijd</label>
                            <select class="form-select @error('tijd') is-invalid @enderror" id="tijd" name="tijd" required>
                                <option value="">Selecteer een tijd</option>
                                <option value="{{ $reservering->tijd }}" selected>
                                    {{ date('H:i', strtotime($reservering->tijd)) }}
                                </option>
                            </select>
                            <small class="form-text text-muted">Opmerking: Na het wijzigen van de medewerker worden alleen beschikbare tijden getoond.</small>
                            @error('tijd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="behandelingen" class="form-label">Behandelingen</label>
                            <div class="form-check" id="behandelingenContainer">
                                @foreach($behandelingen as $behandeling)
                                    <div class="mb-2">
                                        <input class="form-check-input" type="checkbox" name="behandelingen[]" value="{{ $behandeling->behandeling_id }}" id="behandeling_{{ $behandeling->behandeling_id }}"
                                            {{ in_array($behandeling->behandeling_id, $huidigeBehandelingen) ? 'checked' : '' }}>
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
                        
                        <div class="mb-3">
                            <label for="opmerkingen" class="form-label">Opmerkingen</label>
                            <textarea class="form-control @error('opmerkingen') is-invalid @enderror" id="opmerkingen" name="opmerkingen" rows="3" placeholder="Voeg eventuele opmerkingen toe voor uw afspraak (max 1000 tekens)">{{ old('opmerkingen', $reservering->opmerkingen) }}</textarea>
                            @error('opmerkingen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Afspraak Bijwerken</button>
                            <a href="{{ route('klanten.index') }}" class="btn btn-secondary">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascript voor dynamische medewerkers en tijden -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const datumInput = document.getElementById('datum');
    const medewerkerSelect = document.getElementById('medewerker_id');
    const tijdSelect = document.getElementById('tijd');
    let currentMedewerkerId = '{{ $reservering->medewerker_id }}';
    let currentTijd = '{{ $reservering->tijd }}';
    
    // Functie om beschikbare medewerkers op te halen
    const fetchMedewerkers = (dayOfWeek) => {
        fetch(`/api/available-medewerkers/${dayOfWeek}`)
            .then(response => response.json())
            .then(data => {
                // Reset de medewerker select maar behoud de huidige medewerker
                const oldMedewerkerId = medewerkerSelect.value;
                medewerkerSelect.innerHTML = '<option value="">Selecteer een medewerker</option>';
                
                if (data.length > 0) {
                    // Store the medewerkers data for later use
                    window.medewerkerData = data;
                    
                    // Voeg medewerkers toe aan de select
                    data.forEach(medewerker => {
                        const option = document.createElement('option');
                        option.value = medewerker.medewerker_id;
                        option.textContent = medewerker.naam;
                        
                        // Selecteer de huidige medewerker indien beschikbaar
                        if (medewerker.medewerker_id == oldMedewerkerId) {
                            option.selected = true;
                            // Update behandelingen container
                            updateBehandelingen(medewerker);
                        }
                        
                        medewerkerSelect.appendChild(option);
                    });
                    
                    // Als de huidige medewerker niet beschikbaar is op deze dag
                    if (medewerkerSelect.value === '') {
                        tijdSelect.innerHTML = '<option value="">Selecteer eerst een medewerker</option>';
                        tijdSelect.disabled = true;
                    } else {
                        // Anders haal tijden op voor de geselecteerde medewerker
                        fetchTijden(medewerkerSelect.value, datumInput.value);
                    }
                } else {
                    medewerkerSelect.innerHTML = '<option value="">Geen medewerkers beschikbaar op deze dag</option>';
                    tijdSelect.innerHTML = '<option value="">Selecteer eerst een medewerker</option>';
                    tijdSelect.disabled = true;
                }
            })
            .catch(error => {
                console.error('Error fetching medewerkers:', error);
            });
    };
    
    // Functie om beschikbare tijden op te halen
    const fetchTijden = (medewerkerId, date) => {
        fetch(`/api/available-times/${medewerkerId}/${date}`)
            .then(response => response.json())
            .then(data => {
                // Reset de tijd select
                tijdSelect.innerHTML = '<option value="">Selecteer een tijd</option>';
                tijdSelect.disabled = false;
                
                // Voeg de huidige tijd toe als deze niet in de beschikbare tijden zit
                let hasCurrentTime = false;
                if (currentMedewerkerId == medewerkerId && date === datumInput.value) {
                    hasCurrentTime = data.includes(currentTijd);
                }
                
                if (!hasCurrentTime) {
                    const option = document.createElement('option');
                    option.value = currentTijd;
                    const timeParts = currentTijd.split(':');
                    option.textContent = `${timeParts[0]}:${timeParts[1]} (huidige tijd)`;
                    option.selected = true;
                    tijdSelect.appendChild(option);
                }
                
                // Voeg beschikbare tijden toe
                if (data.length > 0) {
                    data.forEach(time => {
                        const option = document.createElement('option');
                        option.value = time;
                        
                        // Format the time for display (e.g., "09:00")
                        const timeParts = time.split(':');
                        option.textContent = `${timeParts[0]}:${timeParts[1]}`;
                        
                        // Selecteer de huidige tijd indien beschikbaar
                        if (time === currentTijd) {
                            option.selected = true;
                        }
                        
                        tijdSelect.appendChild(option);
                    });
                } else {
                    tijdSelect.innerHTML = '<option value="">Geen tijden beschikbaar</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching times:', error);
            });
    };
    
    // Functie om behandelingen te updaten
    const updateBehandelingen = (medewerker) => {
        if (medewerker && medewerker.behandelingen) {
            const behandelingenContainer = document.getElementById('behandelingenContainer');
            // Haal huidige geselecteerde behandelingen op
            const selectedBehandelingen = Array.from(behandelingenContainer.querySelectorAll('input[type="checkbox"]:checked')).map(cb => cb.value);
            
            behandelingenContainer.innerHTML = '';
            
            if (medewerker.behandelingen.length > 0) {
                medewerker.behandelingen.forEach(behandeling => {
                    const div = document.createElement('div');
                    div.className = 'mb-2';
                    
                    const input = document.createElement('input');
                    input.className = 'form-check-input';
                    input.type = 'checkbox';
                    input.name = 'behandelingen[]';
                    input.value = behandeling.behandeling_id;
                    input.id = `behandeling_${behandeling.behandeling_id}`;
                    
                    // Check de behandeling als die al geselecteerd was
                    if (selectedBehandelingen.includes(behandeling.behandeling_id.toString())) {
                        input.checked = true;
                    }
                    
                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.htmlFor = `behandeling_${behandeling.behandeling_id}`;
                    label.textContent = `${behandeling.naam} (€${parseFloat(behandeling.prijs).toFixed(2)})`;
                    
                    div.appendChild(input);
                    div.appendChild(label);
                    behandelingenContainer.appendChild(div);
                });
            } else {
                behandelingenContainer.innerHTML = '<p>Geen behandelingen beschikbaar voor deze medewerker.</p>';
            }
        }
    };
    
    // Initiële dag van de week ophalen van de geselecteerde datum
    const initialDate = new Date(datumInput.value);
    if (initialDate) {
        const dayOfWeek = initialDate.getDay();
        fetchMedewerkers(dayOfWeek);
    }
    
    // Eventlistener voor datum wijziging
    datumInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate) {
            const dayOfWeek = selectedDate.getDay();
            fetchMedewerkers(dayOfWeek);
        }
    });
    
    // Eventlistener voor medewerker wijziging
    medewerkerSelect.addEventListener('change', function() {
        if (this.value) {
            const medewerkerId = this.value;
            const selectedDate = datumInput.value;
            
            // Update behandelingen voor de geselecteerde medewerker
            const medewerker = window.medewerkerData.find(m => m.medewerker_id == medewerkerId);
            if (medewerker) {
                updateBehandelingen(medewerker);
            }
            
            // Haal beschikbare tijden op
            fetchTijden(medewerkerId, selectedDate);
        } else {
            tijdSelect.innerHTML = '<option value="">Selecteer eerst een medewerker</option>';
            tijdSelect.disabled = true;
        }
    });
});
</script>
@endsection 