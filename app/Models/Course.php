<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    private static $course;

    public static function addOrUpdate($request){
        if(Course::find($request->id)){
            self::$course = Course::find($request->id);
        }

        else{
            self::$course = new Course();
        }
        self::$course->course_name          = $request->course_name;
        self::$course->crt_course_name      = $request->crt_course_name;
        self::$course->course_code          = $request->course_code ;
        self::$course->course_duration      = $request->course_duration;
        self::$course->course_medium_id     = $request->course_medium_id;
        self::$course->course_type          = $request->course_type ;
        self::$course->course_fee           = $request->course_fee;
        self::$course->discount             = $request->discount;
        self::$course->total_lectures       = $request->total_lectures;
        self::$course->course_description   = $request->course_description;
        self::$course->start_date           = $request->start_date;
        self::$course->course_status_id     = $request->course_status_id ;

        self::$course->save();
        return self::$course;
    }

    public static function remove($id){
        self::$course = Course::find($id);
        self::$course->delete();
    }

    public function courseModule()
    {
        return $this->hasMany(CourseModule::class);
    }
}
