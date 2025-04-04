<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BehandelingProduct extends Pivot
{
    protected $table = 'behandeling_product';

    protected $fillable = [
        'behandeling_id',
        'product_id'
    ];
}
