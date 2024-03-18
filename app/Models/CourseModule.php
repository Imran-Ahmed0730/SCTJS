<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;
    private static $courseModule;

    public static function add($request, $courseId)
    {
        if($request->modules != null){
            foreach ($request->modules as $module){
                self::$courseModule = new CourseModule();
                self::$courseModule->course_id = $courseId;
                self::$courseModule->module_name = $module;
                self::$courseModule->save();
            }
        }
    }

    public static function updateModule($request)
    {
        self::remove($request->id);
        self::add($request, $request->id);
    }

    public static function remove($id)
    {
        self::$courseModule = CourseModule::where('course_id', $id)->get();

        foreach (self::$courseModule as $module){
            $module->delete();
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
