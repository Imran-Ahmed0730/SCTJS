<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    private $testimonial;
    public function add()
    {
        return view('admin.testimonial.form');
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        $request->validate([
            'name' => 'unique:testimonials'
        ]);

        $this->testimonial = Testimonial::addOrUpdate($request);

        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Has Been Added in the Gallery Successfully!!');
    }

    public function list()
    {
        $data['items'] = Testimonial::latest()->get();
        return view('admin.testimonial.list', $data);
    }

    public function edit($id)
    {

        $data['item'] = Testimonial::find($id);
        return view('admin.testimonial.form', $data);
    }

    public function update(Request $request)
    {
        $this->validation($request);
        Testimonial::addOrUpdate($request);
        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Has Been Updated in the Gallery Successfully!!');
    }

    public function remove(Request $request)
    {
        Testimonial::remove($request->id);
        return redirect()->route('admin.testimonial.list')->with('message', 'Testimonial Has Been Removed from the Gallery Successfully!!');
    }

    public function validation($request)
    {
        $request->validate([
            'name'=>['required'],
            'description'=>['required']
        ]);
    }
}
