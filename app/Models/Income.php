<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
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
}
