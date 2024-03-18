<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchApply extends Model
{
    use HasFactory;
    private static $branchApplication;
    public static function applyForBranch($request)
    {
//        dd($request);
        self::$branchApplication = new BranchApply();
        self::$branchApplication->name_en               = $request->name_en;
        self::$branchApplication->name_bn               = $request->name_bn;
        self::$branchApplication->father_name           = $request->father_name;
        self::$branchApplication->nid_number            = $request->nid_number;
        self::$branchApplication->institution_name_en   = $request->institution_name_en;
        self::$branchApplication->institution_name_bn   = $request->institution_name_bn;
        self::$branchApplication->address_en            = $request->address_en;
        self::$branchApplication->address_bn            = $request->address_bn;
        self::$branchApplication->phone                 = $request->phone;
        self::$branchApplication->email                 = $request->email;
        self::$branchApplication->status                = 0;
        self::$branchApplication->head_image            = self::saveImageUrl($request, 'head_image');
        self::$branchApplication->nid_image             = self::saveImageUrl($request, 'nid_image');
        self::$branchApplication->trade_licence_image   = self::saveImageUrl($request, 'trade_licence_image');

        self::$branchApplication->save();
    }

    private static function saveImageUrl($request, $file){
        $image = $request->file($file);
        $imageName = $request->name_en. '.' . $image->extension();
        $directory = 'uploads/branch-applications/'.$file.'/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);
//        Session::put($imageUrl);
        return $imageUrl;
    }

    public static function remove($id)
    {
        self::$branchApplication = BranchApply::find($id);
        if (self::$branchApplication->head_image){
            unlink(self::$branchApplication->head_image);
        }
        if (self::$branchApplication->nid_image){
            unlink(self::$branchApplication->nid_image);
        }
        if (self::$branchApplication->image){
            unlink(self::$branchApplication->trade_licence_image);
        }
        self::$branchApplication->delete();
    }
}
