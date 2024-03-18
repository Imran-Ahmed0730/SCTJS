<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    private static $gallery;

    public static function addOrUpdate($request)
    {
        if (Gallery::find($request->id)){
            self::$gallery = Gallery::find($request->id);
        }
        else{
            self::$gallery = new Gallery();
        }

        self::$gallery->title       = $request->title;
        self::$gallery->description = $request->description;

        self::$gallery->save();
        return self::$gallery;
    }

    public static function remove($id)
    {
        self::$gallery = Gallery::find($id);
        self::$gallery->delete();
    }

    public function galleryImage()
    {
        return $this->hasMany(GalleryImage::class);
    }

}
