<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Notice;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $data['item'] = Notice::where('branch_id', '0')->orderBy('id', 'desc')->first();
        return view('admin.dashboard.dashboard', $data);
    }

    public function profile()
    {
        $data['item'] = Branch::where('branch_code', Auth::user()->branch_code)->first();
        return view('admin.branch.profile', $data);
    }
}
