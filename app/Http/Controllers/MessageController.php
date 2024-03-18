<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Message;
use App\Utility\SmsUtility;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $recipient;
    public function add()
    {
        return view('admin.message.form');
    }

    public function submit(Request $request)
    {
//        return $request;
        if($request->branch_id == 0){
            $this->branch = Branch::latest()->get();
//            return $this->branch;
            Message::addMessage($request);
            foreach ($this->branch as $recipient){

                if(substr($recipient->branch_phone,0,3)=="+88"){
                    $phone = $recipient->branch_phone;
                }elseif(substr($recipient->branch_phone,0,2)=="88"){
                    $phone = '+'.$recipient->branch_phone;
                }else{
                    $phone = '+88'.$recipient->branch_phone;
                }
                $message = $request->message;
                SmsUtility::sendSMS($phone, $message);
            }
        }
        else{
            $this->branch = Branch::find($request->branch_id);
            Message::addMessage($request);
            if(substr($this->branch->branch_phone,0,3)=="+88"){
                $phone = $this->branch->branch_phone;
            }elseif(substr($this->branch->branch_phone,0,2)=="88"){
                $phone = '+'.$this->branch->branch_phone;
            }else{
                $phone = '+88'.$this->branch->branch_phone;
            }
            $message = $request->message;
            SmsUtility::sendSMS($phone, $message);

        }

        return redirect()->route('admin.message.list')->with('message', 'Message Has Been Delivered Successfully!!');
    }

    public function list()
    {
        $data['items'] = Message::latest()->get();
        return view('admin.message.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = Message::find($id);
        return view('admin.message.form', $data);
    }
}
