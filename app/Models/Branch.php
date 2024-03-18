<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    private static $branch, $lastBranch;

    public static function addOrUpdate($request){

        self::$lastBranch = Branch::orderBy('id', 'desc')->first();
        if(Branch::find($request->id)){
            self::$branch = Branch::find($request->id);
        }
        else{
            self::$branch = new Branch();
            if(self::$lastBranch){
                self::$branch->branch_code          = self::$lastBranch->branch_code+1;
            }
            else{
                self::$branch->branch_code          = 101;
            }

            self::$branch->join_date            = $request->join_date;
        }

        self::$branch->branch_name              = $request->branch_name;
        self::$branch->branch_email             = $request->branch_email;
        self::$branch->branch_phone             = $request->branch_phone;
        self::$branch->branch_phone             = $request->branch_phone;
        self::$branch->branch_password          = $request->branch_password;
        self::$branch->branch_division          = $request->branch_division;
        self::$branch->branch_district          = $request->branch_district;
        self::$branch->branch_upazila           = $request->branch_upazila ;
        self::$branch->branch_area              = $request->branch_area;
        self::$branch->branch_type_id           = $request->branch_type_id ;
        self::$branch->branch_status_id         = $request->branch_status_id ;
        self::$branch->registration_status_id   = $request->registration_status_id ;

        if ($request->file('head_image')) {
            if (self::$branch->head_image) {
                if (file_exists(self::$branch->head_image)) {
                    unlink(self::$branch->head_image);
                }
                self::$branch->head_image = self::saveImageUrl($request);
            } else {
                self::$branch->head_image = self::saveImageUrl($request);
            }
        }

        if(isset($request->application_id)){
            $applicant = BranchApply::find($request->application_id);
            self::$branch->head_image = $applicant->head_image;
            $applicant->status = 1;
            $applicant->save();
        }

        self::$branch->save();

        return self::$branch;

    }

    private static function saveImageUrl($request){
        $image = $request->file('head_image');
        $imageName = $request->branch_code. '.' . $image->extension();
        $directory = 'uploads/branch-head/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);

        return $imageUrl;
    }

    public static function remove($id){
        self::$branch = Branch::find($id);
        self::$branch->delete();
    }

    public function division(){
        return $this->belongsTo(Division::class, 'branch_division');
    }

    public function district(){
        return $this->belongsTo(District::class, 'branch_district');
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class, 'branch_upazila');
    }

}
