<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function notFound()
    {
        return view('admin.errors.not-found');
    }
}
