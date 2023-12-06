<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Scope a query to only include available products.
     */
    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', 'available');
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => json_decode($value, 1),
        );
    }
}
