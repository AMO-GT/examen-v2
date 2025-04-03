<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Behandeling extends Model
{
    use HasFactory;

    protected $primaryKey = 'behandeling_id';

    protected $fillable = ['naam', 'duur', 'prijs'];

    // 🔁 Relaties
    public function medewerkers()
    {
        return $this->belongsToMany(Medewerker::class, 'medewerker_behandeling', 'behandeling_id', 'medewerker_id');
    }

    public function reserveringen()
    {
        return $this->belongsToMany(Reservering::class, 'reservering_behandeling', 'behandeling_id', 'reservering_id');
    }
}
