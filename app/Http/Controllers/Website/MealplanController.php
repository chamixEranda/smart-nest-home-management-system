<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealType;
use App\Models\MealCategory;

class MealplanController extends Controller
{
    public function index()
    {
        return view('website.meal-planning.meal-plan.index');
    }

    public function mealPage()
    {
        return view('website.meal-planning.meal-plan.meal-plan');
    }

    public function createMealPlan()
    {
        $lims_type_list = MealType::active()->get();
        $lims_category_list = MealCategory::active()->get();
        return view('website.meal-planning.meal-plan.create',compact('lims_type_list','lims_category_list'));
    }
    
}
