<?php

namespace App\Models;
use Iluminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Iluminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nombre', 'descripcion'])]
class Category extends Model
{
    public function medicines():HasMany
    {
        return $this->hasMany[Medicine::class];
    }
}
