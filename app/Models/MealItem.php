<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealItem extends Model
{
    protected $fillable = ['meal_categroy_id', 'meal_type_id', 'name', 'description'];

    public function category()
    {
    	return $this->belongsTo("App\Models\MealCategory", 'meal_categroy_id', 'id');
    }

    public function type()
    {
    	return $this->belongsTo("App\Models\MealType", 'meal_type_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

}
