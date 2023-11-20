<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'expense_category_id',
        'name',
        'purpose',
        'method',
        'date',
        'amount'
    ];

    public function category()
    {
    	return $this->belongsTo("App\Models\ExpenseCategory", 'expense_category_id', 'id');
    }
}
