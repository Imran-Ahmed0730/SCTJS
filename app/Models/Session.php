<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    private static $session, $duration;
    public static function addOrUpdate($request)
    {
        if(Session::find($request->id)){
            self::$session = Session::find($request->id);
        }

        else{
            self::$session = new Session();
        }

        self::$session->session_name = $request->session_name;
        self::$session->session_duration = self::duration($request->session_start_month, $request->session_end_month);
        self::$session->session_start_month  = $request->session_start_month ;
        self::$session->session_start_day = $request->session_start_day;
        self::$session->session_start_year = $request->session_start_year;
        self::$session->session_end_month  = $request->session_end_month ;
        self::$session->session_end_day = $request->session_end_day;
        self::$session->session_end_year = $request->session_end_year;
        self::$session->admission_fee = $request->admission_fee;
        self::$session->session_status_id  = $request->session_status_id ;

        self::$session->save();
    }

    private static function duration($startMonth, $endMonth)
    {
        if($startMonth>$endMonth){
            self::$duration = 12 + ($endMonth - $startMonth);
        }
        elseif($startMonth == $endMonth){
            self::$duration = 1;
        }
        else{
            self::$duration = $endMonth - $startMonth;
        }

        return self::$duration;
    }

    public static function remove($id)
    {
        self::$session = Session::find($id);
        self::$session->delete();
    }
}
