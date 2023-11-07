<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'title',
        'price',
        'description',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
