<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchStudent;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Testimonial;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        $data['studentCount'] = count(BranchStudent::all());
        $data['teachers'] = Teacher::where('status', 1)->get();
        $data['testimonials'] = Testimonial::where('profession', 'Student')->where('status', 1)->get();
        $data['sliders'] = Slider::where('status', 1)->get()->take(5);
        return view('frontend.pages.homepage.index', $data);
    }

    public function examResult()
    {
        if(isset($_GET['student_roll']) && $_GET['student_roll'] >0){
            $data['item'] = BranchStudent::where('student_roll', $_GET['student_roll'])->first();
            return view('frontend.pages.student-result.index', $data);
        }
        return view('frontend.pages.student-result.index');
    }

    public function courses(){
        $data['testimonials'] = Testimonial::where('profession', 'Student')->where('status', 1)->get();
        return view('frontend.pages.courses.index', $data);
    }

    public function gallery(){
        $data['items'] = GalleryImage::latest()->get();
        return view('frontend.pages.gallery.index', $data);
    }

    public function resources(){
        return view('frontend.pages.site-resources.index');
    }

    public function contact(){
        return view('frontend.pages.contact-us.index');
    }

    public function branches(){
        $data = [];
        if (isset($_GET['branch_code']) && $_GET['branch_code'] >0){
            $data['item'] = Branch::where('branch_code', $_GET['branch_code'])->first();
        }
        return view('frontend.pages.branches.index', $data);
    }

    public function about(){
        $data['teachers'] = Teacher::where('status', 1)->get();
        return view('frontend.pages.about-us.index', $data);
    }

    public function privacyPolicy(){
        return view('frontend.pages.privacy-policy.index');
    }

    public function terms(){
        return view('frontend.pages.terms-conditions.index');
    }

    public function cookies(){
        return view('frontend.pages.cookies.index');
    }

    public function help(){
        return view('frontend.pages.help.index');
    }
}
