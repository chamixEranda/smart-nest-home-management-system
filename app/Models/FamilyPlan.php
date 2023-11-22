<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyPlan extends Model
{
    public function category()
    {
    	return $this->belongsTo("App\Models\FamilyPlanCategory", 'plan_category_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
