<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Images extends Model
{
    protected $table = 'images';

    public function car_card(): BelongsToMany
    {
        return $this->belongsToMany(CarCard::class);
    }
}
