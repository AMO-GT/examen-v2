<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $primaryKey = 'feedback_id';

    protected $fillable = ['reservering_id', 'commentaar'];

    // 🔁 Relaties
    public function reservering()
    {
        return $this->belongsTo(Reservering::class, 'reservering_id');
    }
}
