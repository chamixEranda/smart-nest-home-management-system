<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $fillable = ['user_id','name','color'];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function incomes()
    {
        return $this->hasMany("App\Models\Income", 'income_category_id');
    }
}
