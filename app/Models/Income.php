<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'user_id',
        'income_category_id',
        'name',
        'purpose',
        'method',
        'date',
        'amount'
    ];

    public function category()
    {
    	return $this->belongsTo("App\Models\IncomeCategory", 'income_category_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }
}
