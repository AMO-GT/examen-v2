<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedewerkerBehandeling extends Model
{
    protected $table = 'medewerker_behandeling';

    protected $fillable = ['medewerker_id', 'behandeling_id'];

    public $timestamps = false;
    public $incrementing = false;
}
