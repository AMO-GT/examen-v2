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
        'is_actief'
    ];

    protected $casts = [
        'prijs' => 'decimal:2',
        'is_actief' => 'boolean',
    ];
} 