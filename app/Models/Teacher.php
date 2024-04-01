<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    private static $teacher;

    public static function addOrUpdate($request)
    {
        if(Teacher::find($request->id)){
            self::$teacher = Teacher::find($request->id);
        }
        else{
            self::$teacher = new Teacher();
        }

        self::$teacher->name            = $request->name;
        self::$teacher->email           = $request->email;
        self::$teacher->phone           = $request->phone;
//        self::$teacher->password        = $request->password;
        self::$teacher->address         = $request->address;
//        self::$teacher->user_id         = $userId;
//        self::$teacher->course_id       = $request->course_id;
//        self::$teacher->batch_id        = $request->batch_id;
        self::$teacher->designation     = $request->designation;
//        self::$teacher->salary          = $request->salary;
        self::$teacher->join_date       = $request->join_date;
        self::$teacher->status          = $request->status;

        if ($request->file('image')) {
            if (self::$teacher->image) {
                if (file_exists(self::$teacher->image)) {
                    unlink(self::$teacher->image);
                }
                self::$teacher->image = self::saveImageUrl($request);
            }
            else {
                self::$teacher->image = self::saveImageUrl($request);
            }
        }

        self::$teacher->save();
    }

    private static function saveImageUrl($request){
        $image = $request->file('image');
        $imageName = $request->name. '.' . $image->extension();
        $directory = 'uploads/teachers/';
        $imageUrl = $directory.$imageName;
        $image->move($directory, $imageName);

        return $imageUrl;
    }

    public static function remove($id)
    {
        self::$teacher = Teacher::find($id);
        if (self::$teacher->image){
            unlink(self::$teacher->image);
        }
        self::$teacher->delete();
    }

    public function course()
    {
        return $this->hasMany(Course::class, 'course_id');
    }
    public function batch()
    {
        return $this->hasMany(CourseBatch::class, 'batch_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }
}
