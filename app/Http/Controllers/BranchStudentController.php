<?php

namespace App\Http\Controllers;

use App\Models\BranchAccount;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseModuleResult;
use App\Models\ResultGrade;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentPayment;
use Illuminate\Http\Request;
use App\Models\BranchStudent;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Utility\SmsUtility;

class BranchStudentController extends Controller
{
    private $student, $branchStudent, $branchAccount;
    public function add()
    {
        $data['boards'] = ['Dhaka', 'Mymensingh', 'Jashore', 'Comilla', 'Barishal', 'Chittagong', 'Dinajpur', 'Rajshahi', 'Sylhet', 'Madrasah', 'Technical'];
        $data['branch'] = Branch::where('branch_code', Auth::user()->branch_code)->first();
        $data['sessions'] = Session::latest()->get();
        $data['courses'] = Course::latest()->get();
        $data['grades'] = ResultGrade::all();
        return view('admin.student.form', $data);
    }
    public function sms()
    {
//        dd('ok');
        $to = "+8801620132642";
//        $token = "075d49e5ee89bb80c74bc5b0bb490f82";
        $message = "Your Registration Has Been Completed.Please Contact The Branch Head Soon!!";
        SmsUtility::sendSMS($to, $message);
        return back();
    }


    public function submit(Request $request)
    {
        $this->validation($request);
        $this->student = Student::addOrUpdate($request);
        $this->branchStudent = BranchStudent::addOrUpdate($request, $this->student->id);
        BranchAccount::addBill($this->branchStudent);

        if(substr($this->student->student_phone,0,3)=="+88"){
            $phone = $this->student->student_phone;
        }elseif(substr($this->student->student_phone,0,2)=="88"){
            $phone = '+'.$this->student->student_phone;
        }else{
            $phone = '+88'.$this->student->student_phone;
        }
        $course = Course::find($this->branchStudent->course_id);
        $message = 'Dear '.$this->student->student_name.', Your Admission is Successful in '.$course->course_name.'. Your Roll No: '. $this->branchStudent->student_roll.', Registration No: '.$this->branchStudent->student_registration.' - Expert Youth ICT Development.';
        SmsUtility::sendSMS($phone, $message);
        return redirect()->route('student.list')->with('message', 'Student Has Been Added Successfully!!');
    }

    public function list()
    {
        if (Auth::user()->role == 2){
            $students = BranchStudent::where('branch_code', Auth::user()->branch_code)->latest();
        }
        else {
            $students = BranchStudent::latest();
        }

        if(isset($_GET['branch_id']) && $_GET['branch_id']>0){
            $students = $students->where('branch_id', $_GET['branch_id']);
        }
        if(isset($_GET['session_id']) && $_GET['session_id']>0){
            $students = $students->where('session_id', $_GET['session_id']);
        }
        if(isset($_GET['year']) && $_GET['year']>0){
            $students = $students->where('join_year', $_GET['year']);
        }
        if(isset($_GET['course_id']) && $_GET['course_id']>0){
            $students = $students->where('course_id', $_GET['course_id']);
        }
        if(isset($_GET['student_roll']) && $_GET['student_roll']>0){
            $students = $students->where('student_roll', 'like', '%'.$_GET['student_roll'].'%');
        }
//
        $data['items'] = $students->paginate(100);
        return view('admin.student.list', $data);


    }
    public function getStudentByRoll($roll)
    {
        $data['items'] = BranchStudent::where('student_roll', 'like', '%'.$roll.'%')->get();
        return view('admin.student.list', $data);
    }

    public function edit($id)
    {
        $data['boards'] = ['Dhaka', 'Mymensingh', 'Jashore', 'Comilla', 'Barishal', 'Chittagong', 'Dinajpur', 'Rajshahi', 'Sylhet', 'Madrasah', 'Technical'];
        $data['branch'] = Branch::where('branch_code', Auth::user()->branch_code)->first();
//        $data['sessions'] = Session::latest()->get();
//        $data['courses'] = Course::latest()->get();
        $data['grades'] = ResultGrade::all();
        $data['item'] = BranchStudent::find($id);
        return view('admin.student.form', $data);
    }

    public function update(Request $request)
    {
        $this->validation($request);
        $this->student = Student::addOrUpdate($request);
        $this->branchStudent = BranchStudent::addOrUpdate($request, $this->student->id);
//        BranchAccount::addOrUpdate($this->branchStudent, 0);
        return redirect()->route('student.list')->with('message', 'Student Information Has Been Updated Successfully!!');
    }
    public function result()
    {
        $data['grades'] = ResultGrade::all();

        if (Auth::user()->role == 2){
            $students = BranchStudent::where('branch_code', Auth::user()->branch_code)->latest();
        }
        else {
            $students = BranchStudent::latest();
        }

        if(isset($_GET['branch_id']) && $_GET['branch_id']>0){
            $students = $students->where('branch_id', $_GET['branch_id']);
        }
        if(isset($_GET['session_id']) && $_GET['session_id']>0){
            $students = $students->where('session_id', $_GET['session_id']);
        }
        if(isset($_GET['year']) && $_GET['year']>0){
            $students = $students->where('join_year', $_GET['year']);
        }
        if(isset($_GET['course_id']) && $_GET['course_id']>0){
            $students = $students->where('course_id', $_GET['course_id']);
        }
        if(isset($_GET['student_roll']) && $_GET['student_roll']>0){
            $students = $students->where('student_roll', 'like', '%'.$_GET['student_roll'].'%');
        }

        $data['items'] = $students->paginate(100);
        return view('admin.student.result', $data);
    }

    public function resultUpdate(Request $request)
    {
        BranchStudent::resultUpdate($request);
        return back()->with('message', 'Result Updated Successfully!!');
    }

    public function getRegCard()
    {
        if(isset($_GET['student_roll']) && $_GET['student_roll']>0){
            $data['item'] = BranchStudent::where('branch_code', Auth::user()->branch_code)->where('student_roll', $_GET['student_roll'])->first();
            return view('admin.student.get-registration-card', $data);
        }
        return view('admin.student.get-registration-card');
    }

    public function getRegCardSubmit(Request $request)
    {
//        return $request;
        $data['item'] = BranchStudent::where('student_roll', $request->student_roll)->first();
//        return $data;
        return view('admin.student.get-registration-card', $data);
    }

    public function remove(Request $request)
    {
        $this->branchStudent = BranchStudent::find($request->id);
        $this->branchAccount = BranchAccount::where('branch_student_id', $request->id)->first();
        Student::remove($this->branchStudent->student_id);
        BranchStudent::remove($request->id);
        BranchAccount::remove($this->branchAccount->id);
//        StudentPayment::remove($this->branchStudent->student_id);
        return back()->with('message', 'Course Has Been Removed Successfully!!');
    }
    public function validation($request){
        $request->validate([
            'student_name'=>['required'] ,
            'student_phone'=>['required', 'min:11', 'max:16'],
//            'student_image'=>['nullable', 'image', 'mimes:png'],
            'branch_id'=>['required'],
            'session_id'=>['required'],
            'course_id'=>['required']
        ]);
    }


    public function printRegistration($id)
    {

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $branchStudent = BranchStudent::find($id);
        $row = Student::find($branchStudent->student_id);
        $session = Session::find($branchStudent->session_id);
        $branch = Branch::find($branchStudent->branch_id);
        $course = Course::find($branchStudent->course_id);


//die(sizeof($students));

//        if (sizeof($students) > 0) {

            //$default_str_len = 62;
            //$default_space_len = 220;

            header('content-type:image/jpeg');
            ini_set("gd.jpeg_ignore_warning", 1);

            $font = storage_path('app/public/ROBOTO-BOLD-ITALIC.TTF');
            $path = storage_path('app/public/Reg-Card.jpg');
            $image = imagecreatefromjpeg($path);
            $color = imagecolorallocate($image, 19, 21, 22);
//            foreach ($students as $row) {
                //$name=$row['student_name'];
                //imagettftext($image,50,0,600,1025,$color,"ROBOTO-BOLD.TTF",$row['course_name'].' ('.$row['course_code'].')');
                /*	$cname_len = strlen($row['course_name']);
                    if($cname_len<=$default_str_len){
                        $temp = $default_str_len - $cname_len;
                        $default_space_len += $temp * 10;
                    } */

                $serial = $row['id'];
                if (strlen($serial) == 1) {
                    $serial = '00' . $serial;
                } else if (strlen($serial) == 2) {
                    $serial = '0' . $serial;
                }

                $session_start_month = $months[$session['session_start_month'] - 1];
                $session_end_month = $months[$session['session_end_month'] - 1];

                imagettftext($image, 35, 0, 700, 365, $color, $font, $serial);

                //course title
                //imagettftext($image,45,0,$default_space_len,1025,$color,"ROBOTO-BOLD.TTF",$row['course_name']);
                // THE IMAGE SIZE
                $width = imagesx($image);
                $height = imagesy($image);

                // THE TEXT SIZE
                $text_size = imagettfbbox(42, 0,  storage_path('app/public/ROBOTO-BOLD.TTF'), $course['course_name']);
                $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
                $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

                // CENTERING THE TEXT BLOCK
                $centerX = CEIL(($width - $text_width) / 2);
                $centerX = $centerX < 0 ? 0 : $centerX;
                $centerY = CEIL(($height - $text_height) / 2);
                $centerY = $centerY < 0 ? 0 : $centerY;

                //print course title at center of x axis
                imagettftext($image, 42, 0, $centerX, 1225, $color, storage_path('app/public/ROBOTO-BOLD.TTF'), $row['course_name']);


                imagettftext($image, 35, 0, 1000, 1525, $color, $font, $row['student_name']);
                imagettftext($image, 35, 0, 1000, 1625, $color, $font, $row['father_name']);
                imagettftext($image, 35, 0, 1000, 1722, $color, $font, $row['mother_name']);
                if ($row['student_gender'] == 1) {
                    $gender = "Male";
                } else if ($row['student_gender'] == 2) {
                    $gender = "Female";
                } else {
                    $gender = "";
                }
                imagettftext($image, 35, 0, 1000, 1820, $color, $font, $gender);
                imagettftext($image, 35, 0, 1000, 1905, $color, $font, $row['student_dob']);
                imagettftext($image, 35, 0, 1000, 2005, $color, $font, $branch['branch_name'] . ' (' . $branch['branch_code'] . ')');
                imagettftext($image, 35, 0, 1000, 2098, $color, $font, $branchStudent['student_registration']);
                imagettftext($image, 35, 0, 1000, 2280, $color, $font, $branchStudent['student_roll']);
                //imagettftext($image,30,0,1550,2125,$color,$font,$row['session_name']);
                imagettftext($image, 30, 0, 1550, 2280, $color, $font, $session_start_month . ' ' . $session['session_start_year'] . ' - ' . $session_end_month . ' ' . $session['session_end_year']);

                if($row['student_image'] == null){
                    $row['student_image'] = storage_path('app/public/default.png');
                }

                //student photo
                $student_image = imagecreatefrompng($row['student_image']);

                list($width, $height) = getimagesize($row['student_image']);

//                dd($width, $height);
                //imagecopymerge($image, $student_image, 1700, 1400, 0, 0, $width, $height, 100);
                imagecopyresized($image, $student_image, 1700, 1400, 0, 0, $width * 2, $height * 2, $width, $height);


//                $seal_image = imagecreatefrompng(storage_path('app/public/Seal.png'));
//
//                list($width,$height) = getimagesize(storage_path('app/public/Seal.png'));
//                imagecopy($image, $seal_image, 1580, 1500, 0, 0, $width, $height);


                //head of the institute signature
                //$sign_image = imagecreatefrompng("Chairman-Sign.png");
                $sign_image = imagecreatefrompng(storage_path('app/public/Chairman-Sign.png'));

                list($width,$height) = getimagesize(storage_path('app/public/Chairman-Sign.png'));
                //authorization seal
//                imagecopy($image, $seal_image, 1580, 1570, 0, 0, $width, $height);


                //head of the institute signature
//                imagecopymerge($image, $sign_image, 1200, 2500, 0, 0, $width, $height, 100);
                imagecopyresized($image, $sign_image, 1100, 2660, 0, 0, $width , $height , $width, $height);

                $file = 'Reg-Card'.$row['id'];
                $file_path = "uploads/registration/".$file.".png";;
//                $file_path_pdf = "registration/" . $file . ".pdf";
                imagejpeg($image, $file_path);
                imagedestroy($image);
                $data['student'] = $branchStudent;
                $pdf = PDF::loadView('admin.student-doc.registration_card', $data);
                unlink($file_path);
                return $pdf->stream($branchStudent['student_registration'].'.pdf');

//                return back();

    }
    public function printId($id)
    {
            $this->branchStudent = BranchStudent::find($id);
            $data['item'] = $this->branchStudent;
//        return view('admin.student-doc.id-card', $data);
            $pdf = PDF::loadView('admin.student-doc.id-card', $data);

            return $pdf->download('ID Card-'.$this->branchStudent->student_roll.'.pdf');

//        return view('admin.student-doc.admit-card', $data);
    }
    public function printAdmit($id)
    {
        if(getSettings('admit_card_printing_status') == 1){
            $this->branchStudent = BranchStudent::find($id);
            $data['item'] = $this->branchStudent;

            $pdf = PDF::loadView('admin.student-doc.admit-card', $data);

            return $pdf->download('Admit-'.$this->branchStudent->student_roll.'.pdf');
        }
        else{
            return back();
        }
//        return view('admin.student-doc.admit-card', $data);
    }

    public function printResult($id)
    {
        if(getSettings('marksheet_printing_status') == 1){
            $this->branchStudent = BranchStudent::find($id);
            $data['item'] = $this->branchStudent;
            $data['results'] = CourseModuleResult::where('student_id', $this->branchStudent->student_id)->where('course_id', $this->branchStudent->course_id)->get();
//            return view('admin.student-doc.marksheet', $data);
            $pdf = PDF::loadView('admin.student-doc.marksheet', $data);

            return $pdf->stream('Result'.$this->branchStudent->student_roll.'.pdf');
        }
        else{
            return back();
        }
    }


    public function printResultSheet(){

        if(getSettings('branch_result_sheet_printing_status') == 1 || Auth::user()->role == 1){
            if (Auth::user()->role == 1){
//                return 'ok';
                $this->branchStudent = BranchStudent::where('status_id', 1)->orderBy('student_roll', 'asc');

                if(isset($_GET['branch_id']) && $_GET['branch_id'] > 0){
                    $data['branch'] = Branch::find($_GET['branch_id']);
                    $this->branchStudent = $this->branchStudent->where('branch_id', $_GET['branch_id']);
                }
            }
            else{
                $data['branch'] = Branch::where('branch_code', Auth::user()->branch_code)->first();
                $this->branchStudent = BranchStudent::where('branch_code', Auth::user()->branch_code)->orderBy('student_roll', 'asc');
            }

            if(isset($_GET['session_id']) && $_GET['session_id'] > 0){
                $this->branchStudent = $this->branchStudent->where('session_id', $_GET['session_id']);
            }
            if(isset($_GET['course_id']) && $_GET['course_id'] > 0){
                $this->branchStudent = $this->branchStudent->where('course_id', $_GET['course_id']);
            }
            if(isset($_GET['year']) && $_GET['year'] > 0){
                $this->branchStudent = $this->branchStudent->where('join_year', $_GET['year']);
            }

            $data['items'] = $this->branchStudent->get();
//        return count($data['items']);
            $pdf = PDF::loadView('admin.branch-doc.result-sheet', $data);
//            if(Auth::user()->role == 1){
//                return $pdf->download('Result-Sheet'.'.pdf');
//            }
//            else{
                return $pdf->download('Result-Sheet-'.$data['branch']->branch_name.'.pdf');
//            }
        }
        else{
            return back();
        }
//        return view('admin.branch-doc.result-sheet', $data);
    }
}
