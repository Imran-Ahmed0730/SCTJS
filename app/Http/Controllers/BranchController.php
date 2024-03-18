<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchApply;
use App\Models\BranchType;
use App\Models\District;
use App\Models\Division;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    private $branch, $user;
    public function add()
    {
        if (isset($_GET['id']) && isset($_GET['id']) > 0){
            $data['application'] = BranchApply::find($_GET['id']);
        }
        $data['divisions'] = Division::all();
        $data['branch_types'] = BranchType::all();
        return view('admin.branch.form', $data);
    }

    public function getDistrictByDivision($id)
    {
        return response()->json(District::where('division_id', $id)->get());
    }

    public function getUpazilaByDistrict($id)
    {
        return response()->json(Upazila::where('district_id', $id)->get());
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        $this->branch = Branch::addOrUpdate($request);
        $this->addOrUpdateUser($this->branch);
        return redirect()->route('admin.branch.list')->with('message', 'Branch Has Been Added Successfully!!');
    }

    public function list()
    {
        $branches = Branch::orderBy('branch_code', 'desc');
        if(isset($_GET['branch_division']) && $_GET['branch_division']>0){
            $branches = $branches->where('branch_division', $_GET['branch_division']);
            $data['districts'] = District::where('division_id', $_GET['branch_division'])->get();
        }
        if(isset($_GET['branch_district']) && $_GET['branch_district'] > 0){
            $branches = $branches->where('branch_district', $_GET['branch_district']);
            $data['upazilas'] = Upazila::where('district_id', $_GET['branch_district'])->get();
        }
        if(isset($_GET['branch_upazila']) && $_GET['branch_upazila'] > 0){
            $branches = $branches->where('branch_upazila', $_GET['branch_upazila']);

        }
        if(isset($_GET['branch']) && $_GET['branch'] > 0){
            $branches = $branches->where('branch_name', 'like', '%'.$_GET['branch'].'%')->orWhere('branch_code', $_GET['branch']);
        }
//        if(isset($_GET['registration_status']) && $_GET['registration_status']>0){
//            $setting = Setting::where('key', 'registration_status')->first();
//            $setting->value = $_GET['registration_status'];
//            $setting->save();
//            return back();
//        }
        $data['divisions'] = Division::all();
        $data['items'] = $branches->paginate(50);
        return view('admin.branch.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = Branch::find($id);
//        dd($data['item']);
        $data['divisions'] = Division::all();
//        $data['districts'] = District::all();
//        $data['upazilas'] = Upazila::all();
        $data['branch_types'] = BranchType::all();
        return view('admin.branch.form', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'branch_phone'=>['required', 'min:11',' max:16'],
            'branch_name'=>['required'],
            'branch_email'=>['required'],
            'branch_password'=>['required', 'min:5', 'confirmed'],
            'branch_division'=>['required'],
            'branch_district'=>['required'],
            'branch_upazila'=>['required']
        ]);;
        $this->branch = Branch::addOrUpdate($request);
        $this->addOrUpdateUser($this->branch);
        return redirect()->route('admin.branch.list')->with('message', 'Branch Information Has Been Update Successfully!!');
    }

    public function remove(Request $request)
    {
        $this->branch = Branch::find($request->id);
//        return $this->branch;
        Branch::remove($request->id);
        $this->removeUser($this->branch->branch_code);
        return back()->with('message', 'Branch Has Been Removed Successfully!!');
    }

    private function addOrUpdateUser($branch)
    {
        if(User::where('branch_code', $branch->branch_code)->first()){
            $this->user = User::where('branch_code', $branch->branch_code)->first();
        }
        else{
            $this->user = new User();
            $this->user->name = $branch->branch_name;
            $this->user->branch_code = $branch->branch_code;

        }
        $this->user->password = bcrypt($branch->branch_password);
        $this->user->email = $branch->branch_email;
        $this->user->save();
    }

    public function removeUser($branch_code)
    {
        $this->user = User::where('branch_code', $branch_code)->first();
        $this->user->delete();
    }

    public function validation($request){
        $request->validate([
            'branch_phone'=>['required', 'min:11',' max:16'],
            'branch_name'=>['required'],
            'branch_email'=>['required', 'unique:branches'],
            'branch_password'=>['required', 'min:8', 'confirmed'],

            'branch_division'=>['required'],
            'branch_district'=>['required'],
            'branch_upazila'=>['required']
        ]);
    }
}
