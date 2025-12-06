<?php

namespace App\Models;

use App\Http\Resources\CharacterResource;
use App\Http\Resources\ModelResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marka extends Model
{
    protected $table = 'marks';

    public $timestamps = false;

    public function models(): HasMany
    {
        return $this->hasMany(Models::class, 'mark_id');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(CarCard::class, 'mark_id');
    }

    public function marksAndModels()
    {
        $collection =  ModelResource::collection(Marka::all());

        return $collection->values();
    }

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'mark_id');
    }
    public function carsCharacters()
    {
        $collection =  CharacterResource::collection(Marka::all());

        return $collection->values();

        // return (new CharacterResource(null))->toArray(request());
    }
}
