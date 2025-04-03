<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tijdsblok extends Model
{
    use HasFactory;

    protected $primaryKey = 'tijdsblok_id';

    protected $fillable = ['medewerker_id', 'starttijd', 'eindtijd'];

    // 🔁 Relaties
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id');
    }
}
