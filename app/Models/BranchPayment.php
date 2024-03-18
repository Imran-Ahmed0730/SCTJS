<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchPayment extends Model
{
    use HasFactory;
    private static $branchPayment;
    public static function addOrUpdatePayment($request)
    {
        if(BranchAccount::find($request->id)){
            self::$branchPayment = BranchPayment::find($request->id);
        }
        else{
            self::$branchPayment = new BranchPayment();
            self::$branchPayment->bill_date = date('Y-m-d');
            self::$branchPayment->payment_date = date('Y-m-d');
            self::$branchPayment->bill_month = date('m');
            self::$branchPayment->bill_year = date('Y');

        }

        self::$branchPayment->branch_id = $request->branch_id;
        self::$branchPayment->payment = $request->payment;
        self::$branchPayment->comments = $request->comments;
        self::$branchPayment->save();

    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
