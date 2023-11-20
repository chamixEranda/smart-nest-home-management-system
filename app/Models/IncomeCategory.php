<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $fillable = ['name'];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
