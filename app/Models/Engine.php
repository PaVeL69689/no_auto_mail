<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Engine extends Model
{
    protected $table = "engine";
    public $timestamps = false;

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'engine_id');
    }
    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'engine_id');    
    }
}
