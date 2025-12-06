<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $table = 'type';

    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'category_id');    
    }
}
