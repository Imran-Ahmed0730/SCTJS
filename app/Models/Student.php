<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Student extends Model
{
    use HasFactory;
    private static $student, $branchStudent;

    public static function addOrUpdate($request)
    {
        if (Student::find($request->id)) {
            self::$student = Student::find($request->id);
        }
        else {
            self::$student = new Student();
            self::$student->join_date       = date('Y-m-d');
        }

        self::$student->student_name        = $request->student_name;
        self::$student->student_dob         = $request->student_dob;
        self::$student->student_phone       = $request->student_phone;
        self::$student->student_email       = $request->student_email;
        self::$student->student_gender      = $request->student_gender;
        self::$student->student_religion    = $request->student_religion;
        self::$student->student_nationality = $request->student_nationality;
        self::$student->father_name         = $request->father_name;
        self::$student->mother_name         = $request->mother_name;
        self::$student->jsc_board           = $request->jsc_board;
        self::$student->jsc_year            = $request->jsc_year;
        self::$student->jsc_roll            = $request->jsc_roll;
        self::$student->jsc_result          = $request->jsc_result;
        self::$student->ssc_board           = $request->ssc_board;
        self::$student->ssc_year            = $request->ssc_year;
        self::$student->ssc_roll            = $request->ssc_roll;
        self::$student->ssc_result          = $request->ssc_result;
        self::$student->student_status_id   = $request->student_status_id;

        if ($request->file('student_image')) {
            if (self::$student->student_image) {
                if (file_exists(self::$student->student_image)) {
                    unlink(self::$student->student_image);
                }
                self::$student->student_image = self::saveImageUrl($request);
            } else {
                self::$student->student_image = self::saveImageUrl($request);
            }
        }
        self::$student->save();
        return self::$student;
    }

    private static function saveImageUrl($request){

        $image = $request->file('student_image');
        $imageName = $request->student_name. '-'. $request->student_phone. '.png';
        $directory = 'uploads/';
        $imageUrl = $directory.$imageName;
        $image = Image::make($image->getRealPath())->resize(200, 200)->encode('png');
//        $image->move($directory, $imageName);
        $image->save(public_path($imageUrl));
        return $imageUrl;
    }

    public static function remove($id)
    {
        self::$student = Student::find($id);
        self::$student->delete();
    }

}
