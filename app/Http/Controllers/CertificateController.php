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
        //return view('admin.student-doc.certificate', $data);
//        return back();
        return $this->print($data);
    }

    public function print($data){
//if($branchStudent){
//    dd($students);
        $row = $data['branchStudent'];

        //$default_str_len = 62;
        //$default_space_len = 220;


        header('content-type:image/jpeg');
        ini_set("gd.jpeg_ignore_warning", 1);
        //$font="./timesbi.ttf";
        $font = storage_path('app/public/timesbi.ttf');
        //$path = asset('/').'admin-assets/images/cert-new.jpg';
        //$path = Storage::url('admin-assets/images/cert-new.jpg');
        $path = storage_path('app/public/cert-new.jpg');
        //$image=imagecreatefromjpeg("public/cert-new.jpg");
        //$image_path = \File::allFiles(public_path('admin-assets/images/cert-new.jpg'));
        //$image_path = URL::to('/').'/admin-assets/images/cert-new.jpg';
        $image=imagecreatefromjpeg($path);

        $width = imagesx($image);
        $height = imagesy($image);

//        $image = imagecreatefromjpeg(storage_path('app/public/cert-new.jpg'));
        $image = imagecreatetruecolor($width,$height);

        imagealphablending($image, true);
        imagesavealpha($image, true);


        imagefill($image,0,0,0x7fff0000);
        $black = imagecolorallocate($image,19,21,22);


        //$name=$row['student_name'];
        //imagettftext($image,50,0,600,1025,$color,"ROBOTO-BOLD.TTF",$row['crt_course_name'].' ('.$row['course_code'].')');
        /*	$cname_len = strlen($row['crt_course_name']);
        if($cname_len<=$default_str_len){
            $temp = $default_str_len - $cname_len;
            $default_space_len += $temp * 10;
        } */

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

        $session_start_month = $months[$session['session_start_month']-1];
        $session_end_month = $months[$session['session_end_month']-1];

        //imagettftext($image,25,0,700,365,$color,$font,$serial);

        //course title
        //imagettftext($image,45,0,$default_space_len,1025,$color,"ROBOTO-BOLD.TTF",$row['crt_course_name']);
        // THE IMAGE SIZE

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

        $color=imagecolorallocate($image,19,21,22);
        $color = null;

        imagettftext($image,23,0,1610,452,$color,$font,$row['student_roll']);
        imagettftext($image,23,0,1595,523,$color,$font,$row['student_registration']);
        imagettftext($image,23,0,1610,605,$color,$font,date("d/m/Y"));


        imagettftext($image,25,0,820,670,$color,$font,ucwords(strtolower($student['student_name'])));
        imagettftext($image,25,0,740,755,$color,$font,ucwords(strtolower($student['father_name'])));
        imagettftext($image,25,0,1420,755,$color,$font,ucwords(strtolower($student['mother_name'])));
        imagettftext($image, 25, 0, 940, 840, $color, $font, ucwords(strtolower($course['crt_course_name'])));
        imagettftext($image,25, 0, 780, 925,$color,$font,ucwords(strtolower($branch['branch_name'])));
        imagettftext($image,25,0,1720,930,$color,$font,$branch['branch_code']);
        //imagettftext($image,30,0,1550,2125,$color,$font,$row['session_name']);
        imagettftext($image,25,0,700,1010,$color,$font,$session_start_month.', '.$session['session_start_year']);
        imagettftext($image,25,0,1080,1010,$color,$font,$session_end_month.', '.$session['session_end_year']);
        imagettftext($image,25,0,1660,1015,$color,$font,$grade);


        //student photo
        //$student_image=imagecreatefrompng($student['student_image']);
        $student_image = storage_path('app/public/student.png');

        //list($width,$height) = getimagesize($student['student_image']);
        list($width,$height) = getimagesize($student_image);
        //imagecopymerge($image, $student_image, 1700, 1400, 0, 0, $width, $height, 100);
        //imagecopyresized($image, $student_image, 1700, 1400, 0, 0, $width*2, $height*2, $width, $height);

        //authorization seal
        //$seal_image=imagecreatefrompng("Seal.png");
        $seal_image = imagecreatefrompng(storage_path('app/public/Seal.png'));

        list($width,$height) = getimagesize(storage_path('app/public/Seal.png'));
        //imagecopy($image, $seal_image, 1580, 1200, 0, 0, $width, $height);


        //head of the institute signature
        //$sign_image = imagecreatefrompng("Chairman-Sign.png");
        $sign_image = imagecreatefrompng(storage_path('app/public/Chairman-Sign.png'));

        list($width,$height) = getimagesize(storage_path('app/public/Chairman-Sign.png'));
        imagecopy($image, $sign_image, 1560, 1165, 0, 0, $width, $height);
        //imagecopymerge($image, $sign_image, 1200, 2500, 0, 0, $width, $height, 100);
        //imagecopyresized($image, $sign_image, 1200, 2440, 0, 0, $width*2, $height*2, $width, $height);

        //MD signature
        //$sign_image = imagecreatefrompng("MD-Sign.png");
        $sign_image = imagecreatefrompng(storage_path('app/public/MD-Sign.png'));

        list($width,$height) = getimagesize(storage_path('app/public/MD-Sign.png'));
        //imagecopy($image, $sign_image, 1150, 1230, 0, 0, $width, $height);
        imagecopyresized($image, $sign_image, 1090, 1185, 0, 0, $width*2/3, $height*2/3, $width, $height);


        $file=time().'_'.$row['student_id'];
        $file_path="uploads/certificate/".$file.".png";
//        $file_path=storage_path("app/public/".$file.".png");
//        $file_path_pdf="registration/".$file.".pdf";
        $image = imagepng($image);
        imagedestroy($image);
//        unlink($file_path);
//        return $file_path;

//        $contents=  file_get_contents($file_path);
//
//        $expires = 14 * 60*60*24;
//
//        header("Content-Type: image/png");
//        header("Content-Length: " . strlen($contents));
//        header("Cache-Control: public", true);
//        header("Pragma: public", true);
//        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT', true);
//
//        echo $contents;
//        exit;
    }
}
