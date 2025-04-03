<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GewerkteUur extends Model
{
    use HasFactory;

    protected $table = 'gewerkte_uren'; // Atypische meervoudsvorm

    protected $fillable = ['medewerker_id', 'datum', 'uren'];

    public $incrementing = false; // Omdat de primary key samengesteld is
    public $timestamps = true;

    // 🔁 Relaties
    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id');
    }
}
