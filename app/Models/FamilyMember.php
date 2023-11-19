<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'dob',
        'gender',
        'phone_number',
        'family_position',
        'is_active'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}
