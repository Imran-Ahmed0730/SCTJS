<?php

namespace App\Models;

use App\Http\Controllers\BillTypeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    use HasFactory;
    private static $billType;

    public static function addOrUpate($request)
    {

        if(BillType::find($request->id)){
            self::$billType = BillType::find($request->id);
        }

        else{
            self::$billType = new BillType();
        }

        self::$billType->bill_type_name = $request->bill_type_name;
        self::$billType->bill_amount = $request->bill_amount;
        if($request->bill_amount >0){
//            dd($request);
            self::$billType->has_amount = 1;
        }
        else{

            self::$billType->has_amount = 0;
        }
        self::$billType->save();
    }

    public static function remove($id)
    {
        self::$billType = BillType::find($id);
        self::$billType->delete();
    }
}
