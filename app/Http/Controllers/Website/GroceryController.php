<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingredient;
use App\Models\Recipe;

class GroceryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lims_ingredient_data = Ingredient::where('user_id', auth()->user()->id)->paginate(10);
        return view('website.meal-planning.grocery.index',compact('lims_ingredient_data'));
    }

    public function addIngredients()
    {
        return view('website.meal-planning.grocery.add-ingredients');
    }

    public function updateStock($id, $action)
    {
        try {
            DB::beginTransaction();

            $lims_ingredient = Ingredient::find($id);
            if ($lims_ingredient->in_stcok != 0) {
                    if ($action == 'plus')
                $lims_ingredient->in_stcok += 1;
                else 
                    $lims_ingredient->in_stcok -= 1;
            }
            $lims_ingredient->save();

            DB::commit();

            return response()->json(['status' => true, 'message' => translate('messages.ingredient_stock_updated')]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'image'      => 'required',
            'in_stcok'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $new_ingredient = new Ingredient();
        $new_ingredient->user_id = auth()->user()->id;
        $new_ingredient->name = $request->input('name');
        $new_ingredient->in_stcok = $request->input('in_stcok');

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
                $document->move('public/documents/grocery', $documentName);
            }
            else {
                $documentName = $this->getTenantId() . '_' . $documentName . '.' . $ext;
                $document->move('public/documents/grocery', $documentName);
            }
            $new_ingredient->image = $documentName;
        }
        $new_ingredient->save();

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.ingredient_created_successfully')]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
