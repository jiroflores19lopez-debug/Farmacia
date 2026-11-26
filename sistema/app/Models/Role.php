<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'nombre', 'descripcion'])]
class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->nombre,
            set: fn ($value) => ['nombre' => $value],
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->descripcion,
            set: fn ($value) => ['descripcion' => $value],
        );
    }
}
