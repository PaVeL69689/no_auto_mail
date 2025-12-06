<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Models extends Model
{
    protected $table = 'models';

    public $timestamps = false;

    public function marka(): BelongsTo
    {
        return $this->belongsTo(Marka::class);
    }
    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'model_id');
    }
    public function carCard(): HasMany
    {
        return $this->hasMany(CarCard::class, 'model_id');    
    }
}
