<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    protected $table = "colors";
    public $timestamps = false;

    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'color_id');    
    }

}
