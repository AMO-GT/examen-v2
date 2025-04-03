<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klant extends Model
{
    use HasFactory;

    protected $primaryKey = 'klant_id';

    protected $fillable = ['naam', 'email'];

    // 🔁 Relaties
    public function reserveringen()
    {
        return $this->hasMany(Reservering::class, 'klant_id');
    }
}
