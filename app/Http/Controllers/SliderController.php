<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    private $slider;
    public function add()
    {
        return view('admin.slider.form');
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        $this->slider = Slider::addOrUpdate($request);

        return redirect()->route('admin.gallery.list')->with('message', 'Slider Has Been Added in the Gallery Successfully!!');
    }

    public function list()
    {
        $data['items'] = Slider::latest()->get();
        return view('admin.slider.list', $data);
    }

    public function edit($id)
    {

        $data['item'] = Slider::find($id);
        return view('admin.slider.form', $data);
    }

    public function update(Request $request)
    {
        $this->validation($request);
        Slider::addOrUpdate($request);
        return redirect()->route('admin.slider.list')->with('message', 'Slider Has Been Updated in the Gallery Successfully!!');
    }

    public function remove(Request $request)
    {
        Slider::remove($request->id);
        return redirect()->route('admin.gallery.list')->with('message', 'Slider Has Been Removed from the Gallery Successfully!!');
    }

    public function validation($request)
    {
        $request->validate([
            'title'=>['required'],
            'image'=>['required']
        ]);
    }
}
