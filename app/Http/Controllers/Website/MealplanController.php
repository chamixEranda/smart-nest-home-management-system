<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealType;
use App\Models\MealCategory;
use App\Models\MealItem;

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

    public function generateMealPlan(Request $request)
    {
        $lims_meal_list = MealItem::active()->where('meal_categroy_id',$request->input('meal_category'))
        ->where('meal_type_id', $request->input('meal_type'))
        ->get();

        return response()->json([
            'status' =>true,
            'view' => view('website.meal-planning.meal-plan._modal.meal-plan-list',compact('lims_meal_list'))->render()
        ]);
    }
    
}
