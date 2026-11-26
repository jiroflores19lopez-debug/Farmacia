<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'nombre', 'dni', 'phone', 'age'])]
class Customer extends Model
{
    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name,
            set: fn ($value) => ['name' => $value],
        );
    }
}
