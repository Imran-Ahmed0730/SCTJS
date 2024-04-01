<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    private static $setting;

    public static function updateSetting($request)
    {
        for($i=0; $i<count($request->key); $i++){
            if($request->key[$i] != 'site_logo' && $request->key[$i] != 'site_logo_dark' && $request->key[$i] != 'site_icon'){
                self::$setting = Setting::where('key',$request->key[$i])->first();
                self::$setting->value = $request->value[$i];
                self::$setting->save();
            }
        }
//        dd($request->img_key);
        for ($i=0; $i<count($request->img_key);$i++){
            if ($request->file($request->img_key[$i])) {
                $img = Setting::where('key', $request->img_key[$i])->first();
                if ($img->value != null) {
                    if (file_exists($img->value)) {
                        unlink($img->value);
                    }
                    $img->value = self::saveImageUrl($request, $request->img_key[$i]);
                } else {
                    $img->value = self::saveImageUrl($request, $request->img_key[$i]);
                }
                $img->save();
            }
        }

    }

    private static function saveImageUrl($request ,$fileName){

        $image = $request->file($fileName);
        $imageName = $fileName. '.' . $image->extension();
        $directory = 'frontend-assets/img/logo/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);
        return $imageUrl;
    }
}
