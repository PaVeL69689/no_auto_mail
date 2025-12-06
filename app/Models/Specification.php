<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    protected $table = 'specification';

    public function mark(): BelongsTo
    {
        return $this->belongsTo(Marka::class);
    }
    public function model(): BelongsTo
    {
        return $this->belongsTo(Models::class);
    }
    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }
    public function drive(): BelongsTo
    {
        return $this->belongsTo(Drive::class);
    }
    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class);
    }
    public function bodywork(): BelongsTo
    {
        return $this->belongsTo(Bodywork::class);
    }
    public function engine(): BelongsTo
    {
        return $this->belongsTo(Engine::class);
    }
}
