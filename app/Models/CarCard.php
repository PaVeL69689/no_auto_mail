<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class CarCard extends Model
{
    protected $table = "car_card";
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Type::class);    
    }
    public function model(): BelongsTo
    {
        return $this->belongsTo(Models::class);    
    }
    public function mark(): BelongsTo
    {
        return $this->belongsTo(Marka::class);    
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
    public function color(): BelongsTo
    {   
        return $this->belongsTo(Color::class);    
    }
    public function modification(): BelongsTo
    {   
        return $this->belongsTo(Modification::class);    
    }
    public function user(): BelongsTo
    {   
        return $this->belongsTo(User::class);    
    }
    public function engine(): BelongsTo
    {
        return $this->belongsTo(Engine::class);    
    }
    // public function complectation(): BelongsTo
    // {   
    //     return $this->belongsTo(Complectation::class);    
    // }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Images::class, 'announcement_imgs', 'announcement_id', 'image_id');
    }

}
