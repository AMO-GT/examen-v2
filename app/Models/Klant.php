<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Klant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'klanten';
    protected $primaryKey = 'klant_id';

    protected $fillable = [
        'naam',
        'email',
        'password',
        'telefoon',
        'adres',
        'postcode',
        'plaats'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔁 Relaties
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'klant_id');
    }
}
