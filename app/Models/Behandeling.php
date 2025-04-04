<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Behandeling extends Model
{
    use HasFactory;

    protected $table = 'behandelingen';
    protected $primaryKey = 'behandeling_id';

    protected $fillable = [
        'naam',
        'beschrijving',
        'categorie',
        'prijs',
        'duur_minuten',
        'is_actief',
        'is_populair'
    ];

    protected $casts = [
        'prijs' => 'decimal:2',
        'is_actief' => 'boolean',
        'is_populair' => 'boolean'
    ];

    public function medewerkers()
    {
        return $this->belongsToMany(Medewerker::class, 'medewerker_behandeling', 'behandeling_id', 'medewerker_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'behandeling_product', 'behandeling_id', 'product_id')
                    ->withPivot('aantal');
    }
} 