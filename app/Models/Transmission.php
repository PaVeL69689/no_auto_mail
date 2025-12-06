<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transmission extends Model
{
    protected $table = 'transmission';

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'transmission_id');
    }
    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'transmission_id');    
    }
}
