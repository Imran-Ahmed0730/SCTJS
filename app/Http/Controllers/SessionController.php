<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function add()
    {
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.session.form', $data);
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        Session::addOrUpdate($request);
        return redirect()->route('admin.session.list')->with('message', 'Session Has Been Added Successfully!!');
    }

    public function list()
    {
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $session = Session::latest();
        if(isset($_GET['session_status_id']) && $_GET['session_status_id']>=0){
            $session = $session->where('session_status_id', $_GET['session_status_id']);
        }
        $data['items'] = $session->get();
        return view('admin.session.list', $data);
    }

    public function edit($id)
    {

        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data['item'] = Session::find($id);
        return view('admin.session.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        $this->validation($request);
        Session::addOrUpdate($request);
        return redirect()->route('admin.session.list')->with('message', 'Session Has Been Updated Successfully!!');
    }

    public function remove(Request $request)
    {
        Session::remove($request->id);
        return back()->with('message', 'Session Has Been Removed Successfully!!');
    }

    public function validation($request){
        $request->validate([
            'session_name'=>['required'],
            'session_start_month'=>['required'],
            'session_end_month'=>['required'],
            'session_start_year'=>['required'],
            'session_end_year'=>['required'],
            'admission_fee'=>['required'],
        ]);
    }
}
