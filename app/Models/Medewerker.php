<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $primaryKey = 'medewerker_id';

    protected $fillable = ['eigenaar_id', 'naam', 'email', 'werkdagen'];
    
    protected $casts = [
        'werkdagen' => 'array',
    ];

    // 🔁 Relaties
    public function eigenaar()
    {
        return $this->belongsTo(Eigenaar::class, 'eigenaar_id');
    }

    public function producten()
    {
        return $this->belongsToMany(Product::class, 'medewerker_product', 'medewerker_id', 'product_id');
    }

    public function behandelingen()
    {
        return $this->belongsToMany(Behandeling::class, 'medewerker_behandeling', 'medewerker_id', 'behandeling_id');
    }

    public function tijdsblokken()
    {
        return $this->hasMany(Tijdsblok::class, 'medewerker_id');
    }

    public function gewerkteUren()
    {
        return $this->hasMany(GewerkteUur::class, 'medewerker_id');
    }

    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'medewerker_id');
    }
}
