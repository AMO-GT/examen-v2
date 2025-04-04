@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Nieuwe Kapper Toevoegen</h5>
            </div>
            <div class="card-body">
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

                <form action="{{ route('medewerkers.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="naam" class="form-label">Naam</label>
                        <input type="text" name="naam" id="naam" class="form-control" value="{{ old('naam') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mailadres</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('beheerders.index') }}" class="btn btn-secondary">Annuleren</a>
                        <button type="submit" class="btn btn-primary">Kapper Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
