@extends('layouts.app')

@section('content')
    <div class="container" style="font-family: Arial, sans-serif; font-size: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Overzicht Kapers</h2>
            <a href="{{ route('medewerkers.create') }}" class="btn btn-primary">Voeg een medewerker toe</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="text-white" style="background-color: #0047AB;">
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Actie</th>
            </tr>
            </thead>
            <tbody>
            @foreach($medewerkers as $medewerker)
                <tr>
                    <td>{{ $medewerker->medewerker_id }}</td>
                    <td>{{ $medewerker->naam }}</td>
                    <td>{{ $medewerker->email }}</td>
                    <td>
                        <a href="{{ route('medewerkers.show', $medewerker->medewerker_id) }}" class="btn btn-sm btn-outline-info">Bekijk</a>
                        <a href="{{ route('medewerkers.edit', $medewerker->medewerker_id) }}" class="btn btn-sm btn-outline-warning">Bewerk</a>
                        <form action="{{ route('medewerkers.destroy', $medewerker->medewerker_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
