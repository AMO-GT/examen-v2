<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\KlantResetPassword;

class Klant extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new KlantResetPassword($token));
    }
}
