<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    private static $slider;

    public static function addOrUpdate($request)
    {
        if(Slider::find($request->id)){
            self::$slider = Slider::find($request->id);
        }
        else{
            self::$slider = new Slider();
        }
        self::$slider->title = $request->title;
        self::$slider->status = $request->status;
        self::$slider->image = $request->status;

        if ($request->file('image')) {
            if (self::$slider->image) {
                if (file_exists(self::$slider->image)) {
                    unlink(self::$slider->image);
                }
                self::$slider->image = self::saveImageUrl($request);
            } else {
                self::$slider->image = self::saveImageUrl($request);
            }
        }

        self::$slider->save();
    }

    private static function saveImageUrl($request){
        $image = $request->file('image');
        $imageName = $request->title. '.' . $image->extension();
        $directory = 'uploads/sliders/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);

        return $imageUrl;
    }

    public function remove($id)
    {
        self::$slider = Slider::find($id);
        if (self::$slider->image){
            unlink(self::$slider->image);
        }
        self::$slider->delete();
    }
}
