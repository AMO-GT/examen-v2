@extends('layouts.app')

@section('content')
    <div class="container" style="font-family: Arial; font-size: 12px;">
        <h2 class="text-primary">Kapers Informatie</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>Naam:</strong> {{ $medewerker->naam }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $medewerker->email }}</li>
            <li class="list-group-item"><strong>Kaper ID:</strong> {{ $medewerker->medewerker_id }}</li>
        </ul>
        <a href="{{ route('beheerders.index') }}" class="btn btn-secondary mt-3">⬅️ Terug</a>
    </div>
@endsection
