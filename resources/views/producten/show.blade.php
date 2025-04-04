@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Productdetails</h5>
            <div>
                <a href="{{ route('producten.edit', $product->product_id) }}" class="btn btn-light me-2">
                    <i class="fas fa-edit"></i> Bewerken
                </a>
                <a href="{{ route('producten.index') }}" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> Terug
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light">ID</th>
                            <td>{{ $product->product_id }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Naam</th>
                            <td>{{ $product->naam }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Prijs</th>
                            <td>€ {{ number_format($product->prijs, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Aangemaakt op</th>
                            <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Laatst bijgewerkt</th>
                            <td>{{ $product->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Beschrijving</h6>
                        </div>
                        <div class="card-body">
                            {{ $product->beschrijving ?? 'Geen beschrijving beschikbaar' }}
                        </div>
                    </div>
                </div>
            </div>
            
            @if($product->foto_pad)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Productfoto</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $product->foto_pad) }}" alt="{{ $product->naam }}" class="img-fluid" style="max-height: 300px;">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-4">
                <form action="{{ route('producten.destroy', $product->product_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                        <i class="fas fa-trash"></i> Product Verwijderen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 