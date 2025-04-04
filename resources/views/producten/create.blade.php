@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Nieuw Product Toevoegen</h5>
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

            <form action="{{ route('producten.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="naam" class="form-label">Naam</label>
                    <input type="text" class="form-control" id="naam" name="naam" value="{{ old('naam') }}" required>
                </div>

                <div class="mb-3">
                    <label for="prijs" class="form-label">Prijs (€)</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" class="form-control" id="prijs" name="prijs" step="0.01" min="0" value="{{ old('prijs') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="beschrijving" class="form-label">Beschrijving</label>
                    <textarea class="form-control" id="beschrijving" name="beschrijving" rows="4">{{ old('beschrijving') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Productfoto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <div class="form-text">Upload een afbeelding van het product (optioneel)</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('producten.index') }}" class="btn btn-secondary">Annuleren</a>
                    <button type="submit" class="btn btn-primary">Product Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 