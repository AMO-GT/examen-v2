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

    .behandeling-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .behandeling-card:hover {
        border-color: var(--primary-purple);
        background-color: rgba(107, 70, 193, 0.05);
    }
    
    .behandeling-card.selected {
        border-color: var(--primary-purple);
        background-color: rgba(107, 70, 193, 0.1);
    }
    
    .behandeling-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .form-select, .form-control {
        box-shadow: none;
        transition: all 0.2s ease;
    }
    
    .form-select:focus, .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 0.25rem rgba(107, 70, 193, 0.25);
    }
    
    /* Maak formuliervelden groter en beter leesbaar op mobiel */
    @media (max-width: 768px) {
        .form-select, .form-control {
            font-size: 16px;
            padding: 12px;
        }
    }
    
    /* Styling voor de custom datepicker */
    .custom-datepicker {
        position: relative;
    }
    
    .date-picker-box {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: white;
        transition: all 0.3s ease;
    }
    
    .date-picker-header {
        background: var(--gradient-primary);
        color: white;
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .date-picker-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .date-picker-body {
        padding: 15px;
    }
    
    .date-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-top: 10px;
    }
    
    .day-name {
        text-align: center;
        font-weight: 600;
        color: var(--text-color);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    
    .date-btn {
        width: 100%;
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: none;
        background: none;
        font-weight: 500;
        color: var(--text-color);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .date-btn:hover:not(:disabled) {
        background-color: rgba(107, 70, 193, 0.1);
    }
    
    .date-btn.active {
        background: var(--gradient-primary);
        color: white;
    }
    
    .date-btn:disabled {
        color: #ccc;
        cursor: not-allowed;
    }
    
    .date-display {
        padding: 10px 15px;
        font-weight: 500;
        text-align: center;
        color: var(--primary-purple);
    }
    
    .month-navigation {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .month-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .month-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .current-month {
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Styling voor medewerker kaarten */
    .medewerker-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }
    
    .medewerker-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: white;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        height: 100%;
    }
    
    .medewerker-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .medewerker-card.selected {
        border-color: var(--primary-purple);
    }
    
    .medewerker-img {
        height: 120px;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .medewerker-img i {
        font-size: 3rem;
        color: white;
        opacity: 0.8;
    }
    
    .medewerker-info {
        padding: 15px;
        text-align: center;
    }
    
    .medewerker-info h5 {
        margin: 0;
        color: var(--primary-purple);
        font-weight: 600;
    }
    
    /* Styling voor tijd kaarten */
    .tijd-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    .tijd-card {
        flex: 0 0 calc(25% - 10px);
        min-width: 100px;
        border-radius: 10px;
        padding: 15px 10px;
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        border: 2px solid transparent;
    }
    
    .tijd-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    .tijd-card.selected {
        background: var(--gradient-primary);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(107, 70, 193, 0.3);
    }
    
    .tijd-card .tijd {
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .tijd-card {
            flex: 0 0 calc(33.333% - 10px);
        }
    }
    
    @media (max-width: 576px) {
        .tijd-card {
            flex: 0 0 calc(50% - 10px);
        }
    }

    /* Styling voor de stappenplan */
    .appointment-status {
        margin-bottom: 30px;
    }
    
    .step-indicator {
        text-align: center;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 70px;
    }
    
    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #f0f0f0;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }
    
    .step-label {
        font-size: 0.8rem;
        color: #666;
        transition: all 0.3s ease;
    }
    
    .step-indicator.active .step-number {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 3px 10px rgba(107, 70, 193, 0.3);
    }
    
    .step-indicator.active .step-label {
        color: var(--primary-purple);
        font-weight: 600;
    }
    
    .step-indicator.completed .step-number {
        background: var(--primary-purple);
        color: white;
    }
    
    .appointment-step {
        display: none;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .appointment-step.active {
        display: block;
    }
    
    .afspraak-overzicht {
        border-left: 3px solid var(--primary-purple);
    }

    /* Custom Alert Styling */
    #notifications-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        width: 100%;
    }
    
    .custom-alert {
        margin-bottom: 15px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    
    .custom-alert-content {
        display: flex;
        align-items: center;
        padding: 15px;
    }
    
    .custom-alert-success {
        background-color: #f0f9eb;
        border-left: 4px solid #67c23a;
    }
    
    .custom-alert-danger {
        background-color: #fef0f0;
        border-left: 4px solid #f56c6c;
    }
    
    .custom-alert-icon {
        margin-right: 15px;
        font-size: 24px;
    }
    
    .custom-alert-success .custom-alert-icon {
        color: #67c23a;
    }
    
    .custom-alert-danger .custom-alert-icon {
        color: #f56c6c;
    }
    
    .custom-alert-message {
        flex-grow: 1;
        font-size: 14px;
        color: #333;
    }
    
    .custom-alert-close {
        background: none;
        border: none;
        color: #909399;
        cursor: pointer;
        font-size: 16px;
        padding: 0;
        opacity: 0.7;
        transition: opacity 0.3s;
    }
    
    .custom-alert-close:hover {
        opacity: 1;
    }
    
    .custom-alert-progress {
        height: 3px;
        background: #ddd;
        position: relative;
    }
    
    .custom-alert-progress::before {
        content: '';
        position: absolute;
        height: 100%;
        width: 100%;
        left: 0;
        background: linear-gradient(to right, #67c23a, #6B46C1);
        animation: progress-animation 5s linear forwards;
    }
    
    .custom-alert-danger .custom-alert-progress::before {
        background: linear-gradient(to right, #f56c6c, #ff9999);
    }
    
    @keyframes progress-animation {
        from { width: 100%; }
        to { width: 0%; }
    }
    
    /* Animate.css classes */
    .animate__animated {
        animation-duration: 0.5s;
    }
    
    .animate__fadeInDown {
        animation-name: fadeInDown;
    }
    
    .animate__fadeOutUp {
        animation-name: fadeOutUp;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -30px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    @keyframes fadeOutUp {
        from {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
        to {
            opacity: 0;
            transform: translate3d(0, -30px, 0);
        }
    }
</style>

<div class="page-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="section-title text-white" style="-webkit-text-fill-color: white;">Klanten Portaal</h1>
            @if($isAuthenticated)
            <div class="welcome-text text-white">
                <p class="mb-0"><i class="fas fa-user-circle me-2"></i>Welkom, {{ $klant->naam }}</p>
            </div>
            @endif
        </div>
        <p class="lead">Uw persoonlijke omgeving bij The Hair Hub</p>
    </div>
</div>

<div class="container">
    @if($isAuthenticated)
        <!-- Welkomstbericht voor ingelogde gebruikers -->
        <!-- Removing the welcome banner as requested -->
        
        <!-- Enhanced Success/Error Messages -->
        <div id="notifications-container">
            @if(session('success'))
                <div class="custom-alert custom-alert-success animate__animated animate__fadeInDown" role="alert">
                    <div class="custom-alert-content">
                        <div class="custom-alert-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="custom-alert-message">{{ session('success') }}</div>
                        <button type="button" class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="custom-alert-progress"></div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="custom-alert custom-alert-danger animate__animated animate__fadeInDown" role="alert">
                    <div class="custom-alert-content">
                        <div class="custom-alert-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="custom-alert-message">{{ session('error') }}</div>
                        <button type="button" class="custom-alert-close" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="custom-alert-progress"></div>
                </div>
            @endif
        </div>
        
        <div class="row">
            <!-- Linker kolom: Afspraken & Klant informatie -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="sticky-sidebar">
                    <!-- Afspraken Sectie -->
                    <div class="customer-card card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Uw Afspraken</h5>
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="card-body">
                            @if($klant->reserveringen->count() > 0)
                                <div class="appointments-scroll" style="max-height: 300px; overflow-y: auto;">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead style="position: sticky; top: 0; background: white; z-index: 10;">
                                                <tr>
                                                    <th>Datum</th>
                                                    <th>Tijd</th>
                                                    <th>Acties</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Paginate the appointments
                                                    $perPage = 5;
                                                    $currentPage = request()->get('page', 1);
                                                    $offset = ($currentPage - 1) * $perPage;
                                                    $reserveringenPaginated = $klant->reserveringen->sortByDesc('datum')->slice($offset, $perPage);
                                                    $totalPages = ceil($klant->reserveringen->count() / $perPage);
                                                @endphp
                                                
                                                @foreach($reserveringenPaginated as $reservering)
                                                    <tr>
                                                        <td>{{ date('d-m-Y', strtotime($reservering->datum)) }}</td>
                                                        <td>{{ date('H:00', strtotime($reservering->tijd)) }}</td>
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
                                </div>
                                
                                <!-- Pagination controls -->
                                @if($totalPages > 1)
                                <div class="mt-3 d-flex justify-content-center">
                                    <nav aria-label="Afspraken paginering">
                                        <ul class="pagination pagination-sm">
                                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Vorige">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            
                                            @for($i = 1; $i <= $totalPages; $i++)
                                                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            
                                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                                <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Volgende">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle fa-2x me-3"></i>
                                        <p class="mb-0">U heeft nog geen afspraken gepland.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
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
                                <a href="{{ route('klant.edit') }}" class="btn btn-primary btn-sm">
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
            
            <!-- Rechter kolom: Afspraak maken -->
            <div class="col-lg-8">
                <!-- Afspraak maken Sectie -->
                <div class="customer-card card">
                    <div class="card-header">
                        <h5 class="mb-0">Nieuwe Afspraak Maken</h5>
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="card-body">
                        <div class="appointment-form">
                            <!-- Status bar voor afspraak maken -->
                            <div class="appointment-status mb-4">
                                <div class="progress" style="height: 8px; background-color: #f0f0f0;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%; background: var(--gradient-primary);" id="appointment-progress"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="step-indicator active" id="step1-indicator">
                                        <div class="step-number">1</div>
                                        <div class="step-label">Datum</div>
                                    </div>
                                    <div class="step-indicator" id="step2-indicator">
                                        <div class="step-number">2</div>
                                        <div class="step-label">Medewerker</div>
                                    </div>
                                    <div class="step-indicator" id="step3-indicator">
                                        <div class="step-number">3</div>
                                        <div class="step-label">Tijd</div>
                                    </div>
                                    <div class="step-indicator" id="step4-indicator">
                                        <div class="step-number">4</div>
                                        <div class="step-label">Behandelingen</div>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{ route('reserveringen.store') }}" method="POST" id="afspraakForm">
                                @csrf
                                <input type="hidden" name="klant_id" value="{{ $klant->klant_id }}">
                                <input type="hidden" name="datum" id="hidden_datum">
                                
                                <div class="appointment-steps">
                                    <!-- Stap 1: Datum -->
                                    <div class="appointment-step active" id="step1">
                                        <h5 class="mb-3">Stap 1: Kies een datum</h5>
                                        <div class="custom-datepicker">
                                            <div class="date-picker-box">
                                                <div class="date-picker-header">
                                                    <div class="month-navigation">
                                                        <button type="button" class="month-btn" id="prevMonth">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                        <div class="current-month" id="currentMonth"></div>
                                                        <button type="button" class="month-btn" id="nextMonth">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="date-picker-body">
                                                    <div class="date-grid" id="daysOfWeek">
                                                        <div class="day-name">Ma</div>
                                                        <div class="day-name">Di</div>
                                                        <div class="day-name">Wo</div>
                                                        <div class="day-name">Do</div>
                                                        <div class="day-name">Vr</div>
                                                        <div class="day-name">Za</div>
                                                        <div class="day-name">Zo</div>
                                                    </div>
                                                    <div class="date-grid" id="dateGrid"></div>
                                                    <div class="date-display mt-2" id="datumDisplay">Selecteer een datum</div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('datum')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="mt-3 text-end">
                                            <button type="button" class="btn btn-primary" id="nextToStep2">
                                                Volgende <i class="fas fa-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Stap 2: Medewerker -->
                                    <div class="appointment-step" id="step2" style="display: none;">
                                        <h5 class="mb-3">Stap 2: Kies een medewerker</h5>
                                        <div id="medewerkerContainer">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Selecteer eerst een datum
                                            </div>
                                        </div>
                                        <input type="hidden" name="medewerker_id" id="medewerker_id" required>
                                        @error('medewerker_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="mt-3 d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary" id="backToStep1">
                                                <i class="fas fa-arrow-left me-1"></i> Terug
                                            </button>
                                            <button type="button" class="btn btn-primary" id="nextToStep3">
                                                Volgende <i class="fas fa-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Stap 3: Tijd -->
                                    <div class="appointment-step" id="step3" style="display: none;">
                                        <h5 class="mb-3">Stap 3: Kies een tijd</h5>
                                        <div id="tijdContainer">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Selecteer eerst een medewerker
                                            </div>
                                        </div>
                                        <input type="hidden" name="tijd" id="tijd" required>
                                        @error('tijd')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="mt-3 d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary" id="backToStep2">
                                                <i class="fas fa-arrow-left me-1"></i> Terug
                                            </button>
                                            <button type="button" class="btn btn-primary" id="nextToStep4">
                                                Volgende <i class="fas fa-arrow-right ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Stap 4: Behandelingen -->
                                    <div class="appointment-step" id="step4" style="display: none;">
                                        <h5 class="mb-3">Stap 4: Kies behandelingen</h5>
                                        <div id="behandelingenContainer" class="card p-3 bg-white border-0 shadow-sm">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Selecteer eerst een medewerker om beschikbare behandelingen te zien.
                                            </div>
                                        </div>
                                        @error('behandelingen')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="afspraak-overzicht mt-4 mb-4 p-3 bg-light rounded">
                                            <h6 class="mb-3"><i class="fas fa-clipboard-check me-2"></i> Uw afspraak overzicht</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="mb-1"><strong>Datum:</strong></p>
                                                    <p id="overview-datum">Nog niet geselecteerd</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1"><strong>Tijd:</strong></p>
                                                    <p id="overview-tijd">Nog niet geselecteerd</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="mb-1"><strong>Medewerker:</strong></p>
                                                    <p id="overview-medewerker">Nog niet geselecteerd</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3 d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-secondary" id="backToStep3">
                                                <i class="fas fa-arrow-left me-1"></i> Terug
                                            </button>
                                            <button type="submit" class="btn btn-success" id="submitButton">
                                                <i class="fas fa-check me-2"></i>Afspraak Bevestigen
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                            
                        <!-- Javascript voor dynamische medewerkers en tijden -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const hiddenDatumInput = document.getElementById('hidden_datum');
                            const datumDisplay = document.getElementById('datumDisplay');
                            const dateGrid = document.getElementById('dateGrid');
                            const currentMonthElement = document.getElementById('currentMonth');
                            const prevMonthBtn = document.getElementById('prevMonth');
                            const nextMonthBtn = document.getElementById('nextMonth');
                            const medewerkerIdInput = document.getElementById('medewerker_id');
                            const medewerkerContainer = document.getElementById('medewerkerContainer');
                            const tijdInput = document.getElementById('tijd');
                            const tijdContainer = document.getElementById('tijdContainer');
                            const behandelingenContainer = document.getElementById('behandelingenContainer');
                            const submitButton = document.getElementById('submitButton');
                            
                            // Navigatie tussen stappen
                            const step1 = document.getElementById('step1');
                            const step2 = document.getElementById('step2');
                            const step3 = document.getElementById('step3');
                            const step4 = document.getElementById('step4');
                            
                            const step1Indicator = document.getElementById('step1-indicator');
                            const step2Indicator = document.getElementById('step2-indicator');
                            const step3Indicator = document.getElementById('step3-indicator');
                            const step4Indicator = document.getElementById('step4-indicator');
                            
                            const progressBar = document.getElementById('appointment-progress');
                            
                            const nextToStep2Btn = document.getElementById('nextToStep2');
                            const backToStep1Btn = document.getElementById('backToStep1');
                            const nextToStep3Btn = document.getElementById('nextToStep3');
                            const backToStep2Btn = document.getElementById('backToStep2');
                            const nextToStep4Btn = document.getElementById('nextToStep4');
                            const backToStep3Btn = document.getElementById('backToStep3');
                            
                            const overviewDatum = document.getElementById('overview-datum');
                            const overviewTijd = document.getElementById('overview-tijd');
                            const overviewMedewerker = document.getElementById('overview-medewerker');
                            
                            // Navigatie handlers
                            nextToStep2Btn.addEventListener('click', function() {
                                if (!hiddenDatumInput.value) {
                                    datumDisplay.innerHTML = `
                                        <div class="text-danger">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            Selecteer een datum
                                        </div>
                                    `;
                                    return;
                                }
                                
                                step1.classList.remove('active');
                                step2.classList.add('active');
                                step1.style.display = 'none';
                                step2.style.display = 'block';
                                
                                step1Indicator.classList.add('completed');
                                step2Indicator.classList.add('active');
                                
                                progressBar.style.width = '33%';
                            });
                            
                            backToStep1Btn.addEventListener('click', function() {
                                step2.classList.remove('active');
                                step1.classList.add('active');
                                step2.style.display = 'none';
                                step1.style.display = 'block';
                                
                                step2Indicator.classList.remove('active');
                                step1Indicator.classList.remove('completed');
                                step1Indicator.classList.add('active');
                                
                                progressBar.style.width = '0%';
                            });
                            
                            nextToStep3Btn.addEventListener('click', function() {
                                if (!medewerkerIdInput.value) {
                                    medewerkerContainer.innerHTML += `
                                        <div class="alert alert-danger mt-3">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            Selecteer een medewerker
                                        </div>
                                    `;
                                    return;
                                }
                                
                                step2.classList.remove('active');
                                step3.classList.add('active');
                                step2.style.display = 'none';
                                step3.style.display = 'block';
                                
                                step2Indicator.classList.add('completed');
                                step2Indicator.classList.remove('active');
                                step3Indicator.classList.add('active');
                                
                                progressBar.style.width = '66%';
                            });
                            
                            backToStep2Btn.addEventListener('click', function() {
                                step3.classList.remove('active');
                                step2.classList.add('active');
                                step3.style.display = 'none';
                                step2.style.display = 'block';
                                
                                step3Indicator.classList.remove('active');
                                step2Indicator.classList.remove('completed');
                                step2Indicator.classList.add('active');
                                
                                progressBar.style.width = '33%';
                            });
                            
                            nextToStep4Btn.addEventListener('click', function() {
                                if (!tijdInput.value) {
                                    tijdContainer.innerHTML += `
                                        <div class="alert alert-danger mt-3">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            Selecteer een tijd
                                        </div>
                                    `;
                                    return;
                                }
                                
                                step3.classList.remove('active');
                                step4.classList.add('active');
                                step3.style.display = 'none';
                                step4.style.display = 'block';
                                
                                step3Indicator.classList.add('completed');
                                step3Indicator.classList.remove('active');
                                step4Indicator.classList.add('active');
                                
                                progressBar.style.width = '100%';
                                
                                // Update afspraak overzicht
                                const selectedMedewerkerCard = document.querySelector('.medewerker-card.selected');
                                if (selectedMedewerkerCard) {
                                    const medewerkerNaam = selectedMedewerkerCard.querySelector('.medewerker-info h5').textContent;
                                    overviewMedewerker.textContent = medewerkerNaam;
                                }
                                
                                const selectedTimeCard = document.querySelector('.tijd-card.selected');
                                if (selectedTimeCard) {
                                    const tijdTekst = selectedTimeCard.querySelector('.tijd').textContent;
                                    overviewTijd.textContent = tijdTekst;
                                }
                                
                                if (hiddenDatumInput.value) {
                                    overviewDatum.textContent = formateerDatum(hiddenDatumInput.value);
                                }
                            });
                            
                            backToStep3Btn.addEventListener('click', function() {
                                step4.classList.remove('active');
                                step3.classList.add('active');
                                step4.style.display = 'none';
                                step3.style.display = 'block';
                                
                                step4Indicator.classList.remove('active');
                                step3Indicator.classList.remove('completed');
                                step3Indicator.classList.add('active');
                                
                                progressBar.style.width = '66%';
                            });
                            
                            let currentDate = new Date();
                            let selectedDate = null;
                            
                            // Hulpfunctie voor het formatteren van datums
                            function formateerDatum(datumString) {
                                const maanden = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];
                                const dagen = ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'];
                                
                                // Let op: datumString is in formaat YYYY-MM-DD (ISO-formaat)
                                // Maak een nieuwe date-object van de string en corrigeer voor tijdzone-issues
                                const datum = new Date(datumString + 'T00:00:00');
                                
                                // Zorg dat we de correcte dag krijgen, ongeacht de tijdzone
                                const dateParts = datumString.split('-');
                                const year = parseInt(dateParts[0]);
                                const month = parseInt(dateParts[1]) - 1; // Maanden zijn 0-gebaseerd in JavaScript
                                const day = parseInt(dateParts[2]);
                                
                                // Gebruik de lokale tijd voor weergave
                                return `${dagen[datum.getDay()]} ${day} ${maanden[month]} ${year}`;
                            }
                            
                            // Functie om de kalender te renderen
                            function renderCalendar(year, month) {
                                dateGrid.innerHTML = '';
                                
                                // Stel de huidige maand in
                                currentMonthElement.textContent = new Date(year, month, 1).toLocaleDateString('nl-NL', { month: 'long', year: 'numeric' });
                                
                                // Bereken de eerste dag van de maand
                                const firstDay = new Date(year, month, 1).getDay();
                                // In JavaScript is zondag 0, maar we willen maandag als eerste dag (1)
                                const firstDayOfGrid = firstDay === 0 ? 6 : firstDay - 1;
                                
                                // Bereken het aantal dagen in de huidige maand
                                const daysInMonth = new Date(year, month + 1, 0).getDate();
                                
                                // Voeg lege cellen toe voor dagen vóór de eerste dag van de maand
                                for (let i = 0; i < firstDayOfGrid; i++) {
                                    const emptyCell = document.createElement('div');
                                    dateGrid.appendChild(emptyCell);
                                }
                                
                                // Voeg knoppen toe voor elke dag van de maand
                                const today = new Date();
                                today.setHours(0, 0, 0, 0);
                                
                                for (let day = 1; day <= daysInMonth; day++) {
                                    const date = new Date(year, month, day);
                                    const btn = document.createElement('button');
                                    btn.type = 'button';
                                    btn.className = 'date-btn';
                                    btn.textContent = day;
                                    
                                    // Markeer geselecteerde datum
                                    if (selectedDate && date.getTime() === selectedDate.getTime()) {
                                        btn.classList.add('active');
                                    }
                                    
                                    // Schakel datums in het verleden uit
                                    if (date < today) {
                                        btn.disabled = true;
                                    } else {
                                        btn.addEventListener('click', function() {
                                            // Verwijder de actieve klasse van alle datumknoppen
                                            document.querySelectorAll('.date-btn').forEach(btn => {
                                                btn.classList.remove('active');
                                            });
                                            
                                            // Voeg de actieve klasse toe aan de geselecteerde knop
                                            this.classList.add('active');
                                            
                                            // Sla de geselecteerde datum op
                                            selectedDate = new Date(year, month, day);
                                            
                                            // Formatteer de datum in ISO-formaat (YYYY-MM-DD)
                                            // Zorg dat de juiste dag wordt opgeslagen, ook voor de 31e van een maand
                                            const formattedYear = selectedDate.getFullYear();
                                            const formattedMonth = String(selectedDate.getMonth() + 1).padStart(2, '0');
                                            const formattedDay = String(selectedDate.getDate()).padStart(2, '0');
                                            const formattedDate = `${formattedYear}-${formattedMonth}-${formattedDay}`;
                                            
                                            hiddenDatumInput.value = formattedDate;
                                            
                                            // Update de datumweergave
                                            datumDisplay.textContent = formateerDatum(formattedDate);
                                            datumDisplay.style.fontWeight = 'bold';
                                            
                                            // Reset medewerker en tijd
                                            medewerkerIdInput.value = '';
                                            tijdInput.value = '';
                                            
                                            // Reset medewerker en tijd containers
                                            tijdContainer.innerHTML = `
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Selecteer eerst een medewerker
                                                </div>
                                            `;
                                            
                                            // Reset behandelingen container
                                            behandelingenContainer.innerHTML = `
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Selecteer eerst een medewerker om beschikbare behandelingen te zien.
                                                </div>
                                            `;
                                            
                                            // Get the day of week (0 = Sunday, 1 = Monday, etc.)
                                            const dayOfWeek = selectedDate.getDay();
                                            
                                            // Toon laad indicator
                                            medewerkerContainer.innerHTML = `
                                                <div class="alert alert-info">
                                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                                    Medewerkers laden...
                                                </div>
                                            `;
                                            
                                            // Fetch available medewerkers for this day
                                            fetch(`/api/available-medewerkers/${dayOfWeek}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Store the medewerkers data for later use
                                                    window.medewerkerData = data;
                                                    
                                                    // Toon beschikbare medewerkers als kaarten
                                                    if (data.length > 0) {
                                                        let html = '<div class="medewerker-grid">';
                                                        
                                                        data.forEach(medewerker => {
                                                            html += `
                                                                <div class="medewerker-card" data-id="${medewerker.medewerker_id}">
                                                                    <div class="medewerker-img">
                                                                        <i class="fas fa-user-md"></i>
                                                                    </div>
                                                                    <div class="medewerker-info">
                                                                        <h5>${medewerker.naam}</h5>
                                                                    </div>
                                                                </div>
                                                            `;
                                                        });
                                                        
                                                        html += '</div>';
                                                        medewerkerContainer.innerHTML = html;
                                                        
                                                        // Voeg click event toe aan medewerker kaarten
                                                        document.querySelectorAll('.medewerker-card').forEach(card => {
                                                            card.addEventListener('click', function() {
                                                                // Verwijder selected class van alle medewerker kaarten
                                                                document.querySelectorAll('.medewerker-card').forEach(c => {
                                                                    c.classList.remove('selected');
                                                                });
                                                                
                                                                // Voeg selected class toe aan gekozen kaart
                                                                this.classList.add('selected');
                                                                
                                                                // Update hidden input
                                                                const medewerkerId = this.getAttribute('data-id');
                                                                medewerkerIdInput.value = medewerkerId;
                                                                
                                                                // Laad tijden voor deze medewerker
                                                                loadTijden(medewerkerId);
                                                                
                                                                // Laad behandelingen voor deze medewerker
                                                                loadBehandelingen(medewerkerId);
                                                            });
                                                        });
                                                    } else {
                                                        medewerkerContainer.innerHTML = `
                                                            <div class="alert alert-warning">
                                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                                Geen medewerkers beschikbaar op deze dag
                                                            </div>
                                                        `;
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching medewerkers:', error);
                                                    medewerkerContainer.innerHTML = `
                                                        <div class="alert alert-danger">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            Er is een fout opgetreden bij het laden van medewerkers
                                                        </div>
                                                    `;
                                                });
                                        });
                                    }
                                    
                                    dateGrid.appendChild(btn);
                                }
                            }
                            
                            // Functie om tijden te laden voor een medewerker
                            function loadTijden(medewerkerId) {
                                // Toon laad indicator
                                tijdContainer.innerHTML = `
                                    <div class="alert alert-info">
                                        <i class="fas fa-spinner fa-spin me-2"></i>
                                        Beschikbare tijden laden...
                                    </div>
                                `;
                                
                                // Reset tijd input
                                tijdInput.value = '';
                                
                                // Huidige geselecteerde datum
                                const selectedDateStr = hiddenDatumInput.value;
                                
                                // Controleer nogmaals of we een geldige datum en medewerker hebben
                                if (!selectedDateStr || !medewerkerId) {
                                    tijdContainer.innerHTML = `
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Selecteer eerst een geldige datum en medewerker
                                        </div>
                                    `;
                                    return;
                                }
                                
                                console.log(`Tijden ophalen voor medewerker ${medewerkerId} op datum ${selectedDateStr}`);
                                
                                // Fetch beschikbare tijden voor deze medewerker op de geselecteerde datum
                                fetch(`/api/available-times/${medewerkerId}/${selectedDateStr}`)
                                    .then(response => {
                                        // Controleer of de respons OK is
                                        if (!response.ok) {
                                            throw new Error(`HTTP error! Status: ${response.status}`);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log('Tijden data ontvangen:', data);
                                        
                                        // Zelfs als de API een lege array terugstuurt, toon standaard tijden
                                        // Dit is een fallback voor het geval er een probleem is met de tijdsblokken
                                        if (!Array.isArray(data) || data.length === 0) {
                                            // Genereer standaard werktijden als fallback (9:00 - 17:00)
                                            const defaultTimes = ['09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00'];
                                            
                                            let html = `
                                                <div class="alert alert-info mb-3">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Er zijn geen specifieke tijden gevonden. Hieronder ziet u de standaard beschikbare tijden.
                                                </div>
                                                <div class="tijd-grid">
                                            `;
                                            
                                            defaultTimes.forEach(time => {
                                                const timeParts = time.split(':');
                                                const displayTime = `${timeParts[0]}:${timeParts[1]}`;
                                                
                                                html += `
                                                    <div class="tijd-card" data-time="${time}">
                                                        <div class="tijd">${displayTime}</div>
                                                    </div>
                                                `;
                                            });
                                            
                                            html += '</div>';
                                            tijdContainer.innerHTML = html;
                                            
                                            // Voeg click events toe aan tijd kaarten
                                            addTimeCardEvents();
                                        } else {
                                            // Normaal verwerken als we geldige tijden hebben
                                            let html = '<div class="tijd-grid">';
                                            
                                            data.forEach(time => {
                                                // Format the time for display (e.g., "09:00")
                                                const timeParts = time.split(':');
                                                const displayTime = `${timeParts[0]}:${timeParts[1]}`;
                                                
                                                html += `
                                                    <div class="tijd-card" data-time="${time}">
                                                        <div class="tijd">${displayTime}</div>
                                                    </div>
                                                `;
                                            });
                                            
                                            html += '</div>';
                                            tijdContainer.innerHTML = html;
                                            
                                            // Voeg click events toe aan tijd kaarten
                                            addTimeCardEvents();
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching times:', error);
                                        
                                        // Toon een gebruiksvriendelijke foutmelding en bied een fallback
                                        tijdContainer.innerHTML = `
                                            <div class="alert alert-danger mb-3">
                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                Er is een fout opgetreden bij het laden van beschikbare tijden.
                                            </div>
                                            <div class="tijd-grid">
                                                <div class="tijd-card" data-time="09:00:00">
                                                    <div class="tijd">09:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="10:00:00">
                                                    <div class="tijd">10:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="11:00:00">
                                                    <div class="tijd">11:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="13:00:00">
                                                    <div class="tijd">13:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="14:00:00">
                                                    <div class="tijd">14:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="15:00:00">
                                                    <div class="tijd">15:00</div>
                                                </div>
                                                <div class="tijd-card" data-time="16:00:00">
                                                    <div class="tijd">16:00</div>
                                                </div>
                                            </div>
                                        `;
                                        
                                        // Voeg click events toe aan tijd kaarten
                                        addTimeCardEvents();
                                    });
                            }
                            
                            // Helper functie om click events toe te voegen aan tijd kaarten
                            function addTimeCardEvents() {
                                document.querySelectorAll('.tijd-card').forEach(card => {
                                    card.addEventListener('click', function() {
                                        // Verwijder selected class van alle tijd kaarten
                                        document.querySelectorAll('.tijd-card').forEach(c => {
                                            c.classList.remove('selected');
                                        });
                                        
                                        // Voeg selected class toe aan gekozen kaart
                                        this.classList.add('selected');
                                        
                                        // Update hidden input
                                        tijdInput.value = this.getAttribute('data-time');
                                    });
                                });
                            }
                            
                            // Functie om behandelingen te laden voor een medewerker
                            function loadBehandelingen(medewerkerId) {
                                if (!window.medewerkerData) return;
                                
                                const medewerker = window.medewerkerData.find(m => m.medewerker_id == medewerkerId);
                                
                                if (medewerker && medewerker.behandelingen) {
                                    // Update de behandelingen container
                                    let html = '<div class="row">';
                                    
                                    if (medewerker.behandelingen.length > 0) {
                                        medewerker.behandelingen.forEach(behandeling => {
                                            html += `
                                                <div class="col-md-6 mb-2">
                                                    <div class="behandeling-card" data-id="${behandeling.behandeling_id}">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="behandelingen[]" value="${behandeling.behandeling_id}" id="behandeling_${behandeling.behandeling_id}">
                                                            <div class="behandeling-inner">
                                                                <label class="form-check-label" for="behandeling_${behandeling.behandeling_id}">
                                                                    ${behandeling.naam}
                                                                </label>
                                                                <span class="badge bg-primary">€${parseFloat(behandeling.prijs).toFixed(2)}</span>
                                                            </div>
                                                        </div>
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
                                    
                                    // Maak de hele behandeling-card klikbaar
                                    document.querySelectorAll('.behandeling-card').forEach(card => {
                                        card.addEventListener('click', function() {
                                            const checkbox = this.querySelector('input[type="checkbox"]');
                                            checkbox.checked = !checkbox.checked;
                                            
                                            if (checkbox.checked) {
                                                this.classList.add('selected');
                                            } else {
                                                this.classList.remove('selected');
                                            }
                                        });
                                    });
                                }
                            }
                            
                            // Initialiseer de kalender
                            renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
                            
                            // Voeg eventlisteners toe voor maandnavigatie
                            prevMonthBtn.addEventListener('click', function() {
                                currentDate.setMonth(currentDate.getMonth() - 1);
                                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
                            });
                            
                            nextMonthBtn.addEventListener('click', function() {
                                currentDate.setMonth(currentDate.getMonth() + 1);
                                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
                            });
                            
                            // Validatie bij verzenden
                            document.getElementById('afspraakForm').addEventListener('submit', function(e) {
                                // Controleer of er behandelingen zijn geselecteerd
                                const behandelingen = document.querySelectorAll('input[name="behandelingen[]"]:checked');
                                if (behandelingen.length === 0) {
                                    e.preventDefault();
                                    const alertDiv = document.createElement('div');
                                    alertDiv.className = 'alert alert-danger mt-3';
                                    alertDiv.innerHTML = `
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        Selecteer tenminste één behandeling
                                    `;
                                    behandelingenContainer.appendChild(alertDiv);
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

<script>
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.custom-alert');
        
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.classList.remove('animate__fadeInDown');
                alert.classList.add('animate__fadeOutUp');
                
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });
</script>
@endsection


