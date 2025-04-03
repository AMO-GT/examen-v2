<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedewerkerProduct extends Model
{
    protected $table = 'medewerker_product';

    protected $fillable = ['medewerker_id', 'product_id'];

    public $timestamps = false; // tenzij je ze hebt toegevoegd

    public $incrementing = false;
}
