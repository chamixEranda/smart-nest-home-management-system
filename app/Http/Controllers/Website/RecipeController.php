<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_recipe_list = Recipe::where('user_id', auth()->user()->id)->get();
        return view('website.meal-planning.reciepes.index', compact('lims_recipe_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.meal-planning.reciepes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'image'             => 'required',
            'ingredient_name'   => 'required',
            'instruction'       => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }
        DB::beginTransaction();

        $new_recipe = new Recipe();
        $new_recipe->user_id = auth()->user()->id;
        $new_recipe->name = $request->input('name');
        $new_recipe->instruction = $request->input('instruction');
        $new_recipe->ingredients = json_encode($request->ingredient_name);

        $document = $request->image;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $v->errors()
                ]);
            }
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = date("Ymdhis");
            if(!config('database.connections.cloudnist_saas')) {
                $documentName = $documentName . '.' . $ext;
                $document->move('public/documents/recipes', $documentName);
            }
            else {
                $documentName = $this->getTenantId() . '_' . $documentName . '.' . $ext;
                $document->move('public/documents/recipes', $documentName);
            }
            $new_recipe->image = $documentName;
        }
        $new_recipe->save();

        foreach ($request->ingredient_name as $key => $ingredient) {
            $check_exists_ingredient = Ingredient::whereRaw('LOWER(name) = ?', [strtolower($ingredient)])->first();
            if (!$check_exists_ingredient) {
                $new_ingredient = new Ingredient();
                $new_ingredient->name = $ingredient;
                $new_ingredient->save();
            }
        }

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.recipe_created_successfully')]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lims_recipe_data = Recipe::find($id);

        return view('website.meal-planning.reciepes.edit',compact('lims_recipe_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'ingredient_name'   => 'required',
            'instruction'       => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }
        DB::beginTransaction();
        $lims_recipe_data = Recipe::find($id);
        $document = $request->image;
        if ($document) {
            if ($lims_recipe_data->image && file_exists('public/documents/recipes/'.$lims_recipe_data->image)) {
                unlink('public/documents/recipes/'.$lims_recipe_data->image); 
            }
            $documentName = $document->getClientOriginalName();
            $document->move('public/documents/recipes', $documentName);
            $lims_recipe_data->image = $documentName;
        }
        $lims_recipe_data->name = $request->name;
        $lims_recipe_data->instruction = $request->instruction;
        $lims_recipe_data->ingredients = json_encode($request->ingredient_name);
        $lims_recipe_data->save();

        foreach ($request->ingredient_name as $key => $ingredient) {
            $check_exists_ingredient = Ingredient::whereRaw('LOWER(name) = ?', [strtolower($ingredient)])->first();
            if (!$check_exists_ingredient) {
                $new_ingredient = new Ingredient();
                $new_ingredient->name = $ingredient;
                $new_ingredient->save();
            }
        }

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.recipe_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $reciepe = Recipe::find($id);
        if($reciepe->image && file_exists('public/documents/recipes/'.$reciepe->image)) {
            unlink('public/documents/recipes/'.$reciepe->image); 
        }
        $reciepe->delete();

        DB::commit();

        return back();
    }
}
