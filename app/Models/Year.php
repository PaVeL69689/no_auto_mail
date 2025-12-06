<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    protected $table = 'years';
    public $timestamps = false;

    public function specification(): HasMany
    {
        return $this->hasMany(Specification::class, 'year_id');
    }

}
