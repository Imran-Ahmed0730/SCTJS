<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Testimonial extends Model
{
    use HasFactory;
    private static $testimonial, $branchStudent;

    public static function addOrUpdate($request)
    {
        if (Testimonial::find($request->id)) {
            self::$testimonial = Student::find($request->id);
        }
        else {
            self::$testimonial = new Student();
        }

        self::$testimonial->name        = $request->name;
        self::$testimonial->profession  = $request->profession;
        self::$testimonial->description = $request->description;
        self::$testimonial->status      = $request->status;

        if ($request->file('image')) {
            if (self::$testimonial->image) {
                if (file_exists(self::$testimonial->image)) {
                    unlink(self::$testimonial->image);
                }
                self::$testimonial->image = self::saveImageUrl($request);
            } else {
                self::$testimonial->image = self::saveImageUrl($request);
            }
        }
        self::$testimonial->save();
    }

    private static function saveImageUrl($request){

        $image = $request->file('image');
        $imageName = $request->name. '.png';
        $directory = 'uploads/testimonials/';
        $imageUrl = $directory.$imageName;
        $image = Image::make($image->getRealPath())->resize(200, 200)->encode('jpg');
//        $image->move($directory, $imageName);
        $image->save(public_path($imageUrl));
        return $imageUrl;
    }

    public static function remove($id)
    {
        self::$testimonial = Testimonial::find($id);
        if (self::$testimonial->image){
            unlink(self::$testimonial->image);
        }
        self::$testimonial->delete();
    }
}
