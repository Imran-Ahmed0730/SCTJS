<?php

namespace App\Models;

use App\Http\Controllers\NoticeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    private static $notice;

    public static function addOrUpdate($request)
    {
        if(Notice::find($request->id)){
            self::$notice = Notice::find($request->id);
        }

        else{
            self::$notice = new Notice();
            self::$notice->notice_date = $request->notice_date;
            self::$notice->notice_time = date('h:i A');
        }

        self::$notice->notice_title = $request->notice_title;
        self::$notice->notice_description = $request->notice_description;
        self::$notice->branch_id = $request->branch_id;
        self::$notice->notice_status_id = $request->notice_status_id;

        self::$notice->save();
    }

    public static function remove($id)
    {
        self::$notice = Notice::find($id);
        self::$notice->delete();
    }
}
