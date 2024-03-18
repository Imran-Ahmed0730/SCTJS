<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\TableUpdate;

class GalleryImage extends Model
{
    use HasFactory;
    private static $images;

    public static function add($id, $images)
    {
        foreach ($images as $image){
            self::$images = new GalleryImage();
            self::$images->gallery_id = $id;
            self::$images->image_path = self::saveImageUrl($image);
            self::$images->save();
        }
    }

    private static function saveImageUrl($image){
        $imageName = rand(). '.' . $image->extension();
        $directory = 'uploads/gallery-images/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);
        return $imageUrl;
    }

    public static function updateImages($request){
        if($request->image){
            self::remove($request->id);
            self::add($request->id, $request->image);
        }
    }

    public static function remove($id)
    {
        self::$images = GalleryImage::where('gallery_id', $id)->get();
        foreach (self::$images as $image){
            if(file_exists($image->image_path)){
                unlink($image->image_path);
                $image->delete();
            }
        }
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
