<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private $galleryImage;
    public function add()
    {
        return view('admin.gallery.form');
    }

    public function submit(Request $request)
    {

        $this->validation($request);
        $this->galleryImage = Gallery::addOrUpdate($request);
//        return $request;
        GalleryImage::add($this->galleryImage->id, $request->image);
        return redirect()->route('admin.gallery.list')->with('message', 'Images Has Been Added in the Gallery Successfully!!');
    }

    public function list()
    {
        $data['items'] = Gallery::latest()->get();
        return view('admin.gallery.list', $data);
    }

    public function edit($id)
    {

        $data['item'] = Gallery::find($id);
        return view('admin.gallery.form', $data);
    }

    public function update(Request $request)
    {
        $this->validation($request);
        Gallery::addOrUpdate($request);
        GalleryImage::updateImages($request);
        return redirect()->route('admin.gallery.list')->with('message', 'Images Has Been Updated in the Gallery Successfully!!');
    }

    public function remove(Request $request)
    {
        Gallery::remove($request->id);
        GalleryImage::remove($request->id);
        return redirect()->route('admin.gallery.list')->with('message', 'Images Has Been Removed from the Gallery Successfully!!');
    }

    public function validation($request)
    {
        $request->validate([
            'title'=>['required'],
            'image'=>['required']
        ]);
    }

}
