@extends('layouts.app')

@section('content')
    <div class="container" style="font-family: Arial, sans-serif; font-size: 12px;">
        <h2 class="text-warning mb-4">Medewerker Bewerken</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Let op!</strong> Er zijn problemen met je invoer:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('medewerkers.update', $medewerker->medewerker_id) }}" method="POST" class="shadow-sm p-4 border rounded bg-white">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" name="naam" id="naam" class="form-control" value="{{ old('naam', $medewerker->naam) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $medewerker->email) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Opslaan</button>
            <a href="{{ route('beheerders.index') }}" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>
@endsection
