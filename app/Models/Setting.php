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
        self::$setting = Setting::all();
        $i=0;
        foreach (self::$setting as $setting){
            $setting->value = $request->value[$i];
            $setting->save();
            $i++;
        }
    }
}
