<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

//    public function name()
//    {
//        $branch = Branch::where('branch_code', '>', 300)->get();
////        return count($branch);
//
//        foreach ($branch as $b){
//            $user = new User();
//            $user->name = $b->branch_name;
//            $user->email = $b->branch_email;
//            $user->role = 2;
//            $user->branch_code = $b->branch_code;
//            $user->password =  bcrypt($b->branch_password);
//            $user->save();
//
//        }
//        return back();
//    }
    public function login()
    {
        return view('auth.admin.admin-login');
    }
    public function loginSubmit(Request $request)
    {
//        return $request;
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials) ||Auth::attempt(
            ['branch_code'=>$request->email, 'password'=>$request->password
           ] )) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        else{
            Auth::logout();
        }

        return back()->withErrors([
            'err_msg' => ['The credentials does not match our records.']
        ]);
    }
}
