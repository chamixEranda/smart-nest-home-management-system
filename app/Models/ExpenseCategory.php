<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['user_id','name','color'];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function expenses()
    {
        return $this->hasMany("App\Models\Expense", 'expense_category_id');
    }

    public function user()
    {
    	return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }
}
