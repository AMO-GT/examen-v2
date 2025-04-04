<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'producten';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'naam',
        'beschrijving',
        'prijs',
        'eigenaar_id',
        'voorraad'
    ];

    // 🔁 Relaties
    public function eigenaar()
    {
        return $this->belongsTo(Eigenaar::class, 'eigenaar_id', 'eigenaar_id');
    }

    public function medewerkers()
    {
        return $this->belongsToMany(Medewerker::class, 'medewerker_product', 'product_id', 'medewerker_id');
    }

    public function behandelingen()
    {
        return $this->belongsToMany(Behandeling::class, 'behandeling_product', 'product_id', 'behandeling_id')
                    ->withPivot('aantal');
    }
}
