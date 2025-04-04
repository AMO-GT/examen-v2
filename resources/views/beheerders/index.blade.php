@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Overzicht Kappers</h5>
                <a href="{{ route('medewerkers.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle"></i> Nieuwe Kapper
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Naam</th>
                                <th>Email</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medewerkers as $medewerker)
                                <tr>
                                    <td>{{ $medewerker->medewerker_id }}</td>
                                    <td>{{ $medewerker->naam }}</td>
                                    <td>{{ $medewerker->email }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('medewerkers.show', $medewerker->medewerker_id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('medewerkers.edit', $medewerker->medewerker_id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('medewerkers.destroy', $medewerker->medewerker_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
