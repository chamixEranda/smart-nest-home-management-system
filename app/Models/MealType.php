<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
