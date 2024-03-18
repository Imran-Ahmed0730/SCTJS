<?php

namespace App\Http\Controllers;

use App\Models\UserMessage;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    public function submit(Request $request)
    {
//        return $request;
        UserMessage::add($request);
        return back()->with('message', 'Message Has Been Sent Successfully!!');
    }

    public function list()
    {
        $data['items'] = UserMessage::latest()->get();
        return view('admin.message.user-message-list', $data);
    }
}
