<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $family_members = FamilyMember::where('user_id', auth()->user()->id)->active()->get();
        return view('website.relationship-management.family-member.index', compact('family_members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.relationship-management.family-member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'image'             => 'required',
            'dob'               => 'required',
            'gender'            => 'required',
            'phone_number'      => 'required|unique:family_members',
            'family_position'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $family_mamber = new FamilyMember();
        $family_mamber->user_id = auth()->user()->id;
        $family_mamber->name = $request->input('name');
        $family_mamber->dob = $request->input('dob');
        $family_mamber->gender = $request->input('gender');
        $family_mamber->phone_number = $request->input('phone_number');
        $family_mamber->family_position = $request->input('family_position');

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
                $document->move('public/documents/family_members', $documentName);
            }
            else {
                $documentName = $this->getTenantId() . '_' . $documentName . '.' . $ext;
                $document->move('public/documents/family_members', $documentName);
            }
            $family_mamber->image = $documentName;
        }
        $family_mamber->save();

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.family_member_added_successfully')]);
        
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
        $family_member = FamilyMember::find($id);

        return view('website.relationship-management.family-member.edit', compact('family_member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'dob'               => 'required',
            'gender'            => 'required',
            'phone_number'      => 'required',
            'family_position'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $lims_member_data = FamilyMember::find($id);
        $document = $request->image;
        if ($document) {
            if ($lims_member_data->image && file_exists('public/documents/family_members/'.$lims_member_data->image)) {
                unlink('public/documents/family_members/'.$lims_member_data->image); 
            }
            $documentName = $document->getClientOriginalName();
            $document->move('public/documents/family_members', $documentName);
            $lims_member_data->image = $documentName;
        }
        $lims_member_data->name = $request->input('name');
        $lims_member_data->dob = $request->input('dob');
        $lims_member_data->gender = $request->input('gender');
        $lims_member_data->phone_number = $request->input('phone_number');
        $lims_member_data->family_position = $request->input('family_position');
        $lims_member_data->save();

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.family_member_updated_successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $member = FamilyMember::find($id);
        if($member->image && file_exists('public/documents/family_members/'.$member->image)) {
            unlink('public/documents/family_members/'.$member->image); 
        }
        $member->delete();

        DB::commit();

        return back();
    }
}
