<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleResult extends Model
{
    use HasFactory;
    private static $moduleResult, $courseModule;

    public static function add($request)
    {
//        dd($request);
        self::$courseModule = CourseModule::where('course_id', $request->course_id)->get();
        $i=0;
        foreach(self::$courseModule as $module){
            self::$moduleResult = new CourseModuleResult();
            self::$moduleResult->course_id = $request->course_id;
            self::$moduleResult->student_id = $request->student_id;
            self::$moduleResult->module_id = $module->id;
            self::$moduleResult->marks = $request->marks[$i];
            self::$moduleResult->result_grade_id = $request->grade[$i];
            self::$moduleResult->save();
            $i++;
        }
    }

    public static function updateResult($request)
    {
        self::remove($request);
        self::add($request);
    }

    public static function remove($request)
    {
        $records = CourseModuleResult::where('course_id', $request->course_id)->where('student_id', $request->student_id)->get();

        foreach ($records as $record){
            $record->delete();
        }
    }

    public function courseModule()
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }

    public function resultGrade()
    {
        return $this->belongsTo(ResultGrade::class, 'result_grade_id', 'result_grade_id');
    }
}
