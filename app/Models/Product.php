<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = ['naam', 'prijs', 'beschrijving', 'eigenaar_id'];

    // 🔁 Relaties
    public function eigenaar()
    {
        return $this->belongsTo(Eigenaar::class, 'eigenaar_id');
    }

    public function medewerkers()
    {
        return $this->belongsToMany(Medewerker::class, 'medewerker_product', 'product_id', 'medewerker_id');
    }
}
