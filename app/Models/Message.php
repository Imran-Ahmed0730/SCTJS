<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    private static $message;

    public static function addMessage($request)
    {
        self::$message = new Message();
        self::$message->branch_id = $request->branch_id;
        self::$message->message = $request->message;
        self::$message->save();
    }

    public function branch()
    {
       return $this->belongsTo(Branch::class, 'branch_id');
    }
}
