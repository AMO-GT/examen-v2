<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eigenaar extends Model
{
    use HasFactory;

    protected $primaryKey = 'eigenaar_id';

    protected $fillable = [
        'naam',
        'email',
        'password',
        'bedrijfsnaam',
        'adres',
        'postcode',
        'plaats',
        'telefoon'
    ];

    protected $hidden = [
        'password',
    ];

    // Relaties
    public function medewerkers()
    {
        return $this->hasMany(Medewerker::class, 'eigenaar_id');
    }

    public function producten()
    {
        return $this->hasMany(Product::class, 'eigenaar_id');
    }
}
