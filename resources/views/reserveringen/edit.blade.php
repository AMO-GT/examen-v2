@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2 class="mb-0">Afspraak Wijzigen</h2>
                </div>
                <div class="card-body">
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
                        
                        <div class="mb-3">
                            <label for="behandelingen" class="form-label">Behandelingen</label>
                            <div class="form-check" id="behandelingenContainer">
                                @foreach($behandelingen as $behandeling)
                                    <div class="mb-1">
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
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Afspraak Bijwerken</button>
                            <a href="{{ route('klanten.index') }}" class="btn btn-secondary">Annuleren</a>
                        </div>
                    </form>

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
                                        div.className = 'mb-1';
                                        
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 