<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tijdsblok extends Model
{
    use HasFactory;

    protected $table = 'tijdsblokken';
    protected $primaryKey = 'tijdsblok_id';

    protected $fillable = ['medewerker_id', 'day_of_week', 'starttijd', 'eindtijd'];

    // Define day names for easier reference
    public static $dayNames = [
        0 => 'Zondag',
        1 => 'Maandag',
        2 => 'Dinsdag',
        3 => 'Woensdag',
        4 => 'Donderdag',
        5 => 'Vrijdag',
        6 => 'Zaterdag',
    ];

    // Get the day name for this tijdsblok
    public function getDayNameAttribute()
    {
        return self::$dayNames[$this->day_of_week];
    }

    // 🔁 Relaties
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id');
    }
}
