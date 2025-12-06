<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bodywork extends Model
{
     protected $table = 'bodywork';

      public function specification(): HasMany
      {
         return $this->hasMany(Specification::class, 'bodywork_id');
      }
      public function carCard(): HasMany
      {
         return $this->hasMany(CarCard::class, 'bodywork_id');    
      }
}
