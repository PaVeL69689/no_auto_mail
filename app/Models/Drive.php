<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drive extends Model
{
    protected $table = 'drive';

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'drive_id');
    }
    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'drive_id');    
    }
}
