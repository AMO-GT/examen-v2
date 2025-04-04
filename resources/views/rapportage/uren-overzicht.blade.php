@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Maandelijks Uren Overzicht</h5>
        </div>
        <div class="card-body">
            <!-- Eenvoudig filter formulier -->
            <form action="{{ route('rapportage.uren-overzicht') }}" method="GET" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="maand" class="form-label">Maand</label>
                        <select name="maand" id="maand" class="form-select">
                            @foreach($maanden as $key => $value)
                                <option value="{{ $key }}" {{ $maand == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="jaar" class="form-label">Jaar</label>
                        <select name="jaar" id="jaar" class="form-select">
                            @foreach($jaren as $j)
                                <option value="{{ $j }}" {{ $jaar == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="medewerker_id" class="form-label">Medewerker</label>
                        <select name="medewerker_id" id="medewerker_id" class="form-select">
                            <option value="">Alle medewerkers</option>
                            @foreach($medewerkers as $medewerker)
                                <option value="{{ $medewerker->medewerker_id }}" {{ $medewerker_id == $medewerker->medewerker_id ? 'selected' : '' }}>
                                    {{ $medewerker->naam }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filteren
                        </button>
                        @if($medewerker_id)
                            <a href="{{ route('rapportage.uren-overzicht', ['maand' => $maand, 'jaar' => $jaar]) }}" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Rapport details -->
            <div class="alert alert-info">
                <strong>Periode:</strong> {{ $startDatum->format('d-m-Y') }} t/m {{ $eindDatum->format('d-m-Y') }}
                @if($medewerker_id)
                    <span class="ms-3"><strong>Medewerker:</strong> 
                        {{ $medewerkers->where('medewerker_id', $medewerker_id)->first()->naam ?? 'Onbekend' }}
                    </span>
                @endif
            </div>

            <!-- Eenvoudig uren overzicht -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Medewerker</th>
                            <th class="text-center">Totaal Uren</th>
                            <th class="text-center">Werkdagen</th>
                            <th class="text-center">Gem. Uren per Werkdag</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($gewerkteUren) > 0)
                            @foreach($gewerkteUren as $uren)
                                <tr>
                                    <td>{{ $uren->naam }}</td>
                                    <td class="text-center"><strong>{{ $uren->totaal_uren }}</strong></td>
                                    <td class="text-center">{{ $uren->werkdagen }}</td>
                                    <td class="text-center">
                                        {{ $uren->werkdagen > 0 ? number_format($uren->totaal_uren / $uren->werkdagen, 1) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Geen gegevens beschikbaar voor deze periode</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot class="table-dark">
                        <tr>
                            <th>
                                Totaal gewerkte uren {{ $maanden[$maand] }} {{ $jaar }}
                            </th>
                            <th class="text-center">
                                {{ $gewerkteUren->sum('totaal_uren') }}
                            </th>
                            <th class="text-center">{{ $gewerkteUren->sum('werkdagen') }}</th>
                            <th class="text-center">
                                @php
                                    $totaleDagen = $gewerkteUren->sum('werkdagen');
                                    $totaleUren = $gewerkteUren->sum('totaal_uren');
                                    echo $totaleDagen > 0 ? number_format($totaleUren / $totaleDagen, 1) : '-';
                                @endphp
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Eenvoudige samenvatting grafiek -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                @if($medewerker_id)
                                    Uren {{ $medewerkers->where('medewerker_id', $medewerker_id)->first()->naam ?? 'Onbekend' }} - {{ $maanden[$maand] }} {{ $jaar }}
                                @else
                                    Urenverdelingen per Medewerker - {{ $maanden[$maand] }} {{ $jaar }}
                                @endif
                            </h6>
                        </div>
                        <div class="card-body">
                            <canvas id="urenGrafiek" width="100%" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Grafiek voor alle medewerkers
    const ctx = document.getElementById('urenGrafiek').getContext('2d');
    
    // Haal data uit de tabel voor de grafiek
    const labels = [];
    const urenData = [];
    
    @foreach($gewerkteUren as $uren)
        labels.push('{{ $uren->naam }}');
        urenData.push({{ $uren->totaal_uren }});
    @endforeach
    
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: @if($medewerker_id) 
                        'Totaal Uren {{ $medewerkers->where("medewerker_id", $medewerker_id)->first()->naam ?? "Onbekend" }}'
                       @else 
                        'Totaal Uren per Medewerker'
                       @endif,
                data: urenData,
                backgroundColor: 'rgba(107, 70, 193, 0.6)',
                borderColor: 'rgba(107, 70, 193, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Aantal Uren'
                    }
                }
            }
        }
    });
});
</script>
@endpush 