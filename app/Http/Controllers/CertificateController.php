<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchStudent;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Support\Facades\App;
use PDF;
use Dompdf\Dompdf;


class CertificateController extends Controller
{
    public function printCertificate($id)
    {
        $student =BranchStudent::find($id);

        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data['grades'] = ['A+', 'A', 'B', 'C'];
        $data['branchStudent'] = BranchStudent::find($id);
        $data['course'] = getCourseById($student->course_id);
        $data['session'] = Session::find($student->session_id);
        $data['student'] = Student::find($student->student_id);
        $data['branch'] = Branch::find($student->branch_id);

        $row = $data['branchStudent'];

        header('content-type:image/jpeg');
        ini_set("gd.jpeg_ignore_warning", 1);

        $font = storage_path('app/public/timesbi.ttf');

        $path = storage_path('app/public/cert.jpg');

        $image=imagecreatefromjpeg($path);

        $width = imagesx($image);
        $height = imagesy($image);

        $image = imagecreatefromjpeg(storage_path('app/public/cert.jpg'));
//        $image = imagecreatetruecolor($width,$height);

        imagealphablending($image, true);
        imagesavealpha($image, true);


//        imagefill($image,0,0,0x7fff0000);
//        $black = imagecolorallocate($image,19,21,22);


        $serial = $row['student_id'];
        if(strlen($serial)==1){
            $serial = '00'.$serial;
        }else if(strlen($serial)==2){
            $serial = '0'.$serial;
        }

        $grade_id = $row['result_grade_id'];
        if($grade_id==0){
            $grade = '';
        }else if($grade_id>0){
            $grades = $data['grades'];
            $grade = $grades[$row['result_grade_id']-1];
        }

        $months = $data['months'];
        $session = $data['session'];
        $course = $data['course'];
        $student = $data['student'];
        $branch = $data['branch'];
        $issue_date = date('d M, Y');

        $session_start_month = $months[$session['session_start_month']-1];
        $session_end_month = $months[$session['session_end_month']-1];


        // THE TEXT SIZE
        $text_size = imagettfbbox(42, 0, $font, $course['crt_course_name']);
        $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
        $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

        // CENTERING THE TEXT BLOCK
        $centerX = CEIL(($width - $text_width) / 2);
        $centerX = $centerX<0 ? 0 : $centerX;
        $centerY = CEIL(($height - $text_height) / 2);
        $centerY = $centerY<0 ? 0 : $centerY;

        //print course title at center of x axis
        //imagettftext($image, 42, 0, $centerX, 1225, $color, "./ROBOTO-BOLD.TTF", $row['crt_course_name']);

//        $color=imagecolorallocate($image,19,21,22);
        $color = null;

        imagettftext($image,23,0,1510,565,$color,$font,$row['student_roll']);
        imagettftext($image,23,0,1495,625,$color,$font,$row['student_registration']);
//        imagettftext($image,23,0,1610,805,$color,$font,date("d/m/Y"));


        imagettftext($image,25,0,820,770,$color,$font,ucwords(strtolower($student['student_name'])));
        imagettftext($image,25,0,740,840,$color,$font,ucwords(strtolower($student['father_name'])));
        imagettftext($image,25,0,1420,840,$color,$font,ucwords(strtolower($student['mother_name'])));
        imagettftext($image, 25, 0, 930, 910, $color, $font, ucwords(strtolower($course['crt_course_name'])));
        imagettftext($image,25, 0, 780, 972,$color,$font,ucwords(strtolower($branch['branch_name'])));
        imagettftext($image,25,0,1710,972,$color,$font,$branch['branch_code']);
        //imagettftext($image,30,0,1550,2125,$color,$font,$row['session_name']);
        imagettftext($image,25,0,1510,692,$color,$font,$issue_date);
        imagettftext($image,25,0,740,1040,$color,$font,$session_start_month.', '.$session['session_start_year']);
        imagettftext($image,25,0,1165,1040,$color,$font,' '.$session_end_month.', '.$session['session_end_year']);
        imagettftext($image,25,0,1665,1040,$color,$font,$grade);


        //student photo
        //$student_image=imagecreatefrompng($student['student_image']);
        $student_image = storage_path('app/public/student.png');

        //list($width,$height) = getimagesize($student['student_image']);
        list($width,$height) = getimagesize($student_image);
        //imagecopymerge($image, $student_image, 1700, 1400, 0, 0, $width, $height, 100);
        //imagecopyresized($image, $student_image, 1700, 1400, 0, 0, $width*2, $height*2, $width, $height);

        //authorization seal
        //$seal_image=imagecreatefrompng("Seal.png");
//        $seal_image = imagecreatefrompng(storage_path('app/public/Seal.png'));

//        list($width,$height) = getimagesize(storage_path('app/public/Seal.png'));
        //imagecopy($image, $seal_image, 1580, 1200, 0, 0, $width, $height);


        //head of the institute signature
        //$sign_image = imagecreatefrompng("Chairman-Sign.png");
        $sign_image = imagecreatefrompng(storage_path('app/public/Chairman-Sign.png'));

        list($width,$height) = getimagesize(storage_path('app/public/Chairman-Sign.png'));
//        imagecopy($image, $sign_image, 1560, 1165, 0, 0, $width, $height);


        //MD signature
        //$sign_image = imagecreatefrompng("MD-Sign.png");
        $sign_image = imagecreatefrompng(storage_path('app/public/MD-Sign.png'));

        list($width,$height) = getimagesize(storage_path('app/public/MD-Sign.png'));
        //imagecopy($image, $sign_image, 1150, 1230, 0, 0, $width, $height);
//        imagecopyresized($image, $sign_image, 1090, 1185, 0, 0, $width*2/3, $height*2/3, $width, $height);



        $file='Certificate'.'-'.$row['student_roll'];
        $file_path="uploads/certificate/".$file.".png";
//        $file_path=storage_path("app/public/".$file.".png");
//        $file_path_pdf="registration/".$file.".pdf";
        imagejpeg($image, $file_path);
//        imagepng($image);
        imagedestroy($image);
//        unlink($file_path);
//        return $file_path;

        $data['student'] = $row;
        //return view('admin.student-doc.certificate', $data);
        $pdf = PDF::loadView('admin.student-doc.certificate', $data)->setPaper('letter', 'landscape');;
        unlink($file_path);
        return $pdf->stream($row['student_registration'].'.pdf');
    }
}
