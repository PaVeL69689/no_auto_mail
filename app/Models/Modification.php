<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modification extends Model
{
    protected $table = 'modification';

    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'modification_id');    
    }
}
