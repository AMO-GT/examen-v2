<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    use HasFactory;

    protected $table = 'reserveringen';
    protected $primaryKey = 'reservering_id';

    protected $fillable = ['klant_id', 'medewerker_id', 'datum', 'tijd', 'opmerkingen'];

    // 🔁 Relaties
    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id');
    }

    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id');
    }

    public function behandelingen()
    {
        return $this->belongsToMany(Behandeling::class, 'reservering_behandeling', 'reservering_id', 'behandeling_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'reservering_id');
    }
}
