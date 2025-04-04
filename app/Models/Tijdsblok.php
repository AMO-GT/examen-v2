<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tijdsblok extends Model
{
    use HasFactory;

    protected $primaryKey = 'tijdsblok_id';
    
    // Definieer de tabelnaam expliciet
    protected $table = 'tijdsblokken';

    protected $fillable = ['medewerker_id', 'datum', 'starttijd', 'eindtijd'];

    // 🔁 Relaties
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id');
    }
}
