<?php
use Illuminate\Support\Facades\Storage;

if($branchStudent){
//    dd($students);
    $row = $branchStudent;

    //$default_str_len = 62;
    //$default_space_len = 220;


    header('content-type:image/jpeg');
    ini_set("gd.jpeg_ignore_warning", 1);
    $font="./timesbi.ttf";
    //$path = asset('/').'admin-assets/images/cert-new.jpg';
    $path = Storage::url('admin-assets/images/cert-new.jpg');;
    //$image=imagecreatefromjpeg("public/cert-new.jpg");
    $image=imagecreatefromjpeg($path);

    $width = imagesx($image);
    $height = imagesy($image);

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
        $grade = $grades[$row['result_grade_id']-1];
    }

    $session_start_month = $months[$session['session_start_month']-1];
    $session_end_month = $months[$session['session_end_month']-1];

    //imagettftext($image,25,0,700,365,$color,$font,$serial);

    //course title
    //imagettftext($image,45,0,$default_space_len,1025,$color,"ROBOTO-BOLD.TTF",$row['crt_course_name']);
    // THE IMAGE SIZE

    // THE TEXT SIZE
    $text_size = imagettfbbox(42, 0, "./timesbi.ttf", $row['crt_course_name']);
    $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
    $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

    // CENTERING THE TEXT BLOCK
    $centerX = CEIL(($width - $text_width) / 2);
    $centerX = $centerX<0 ? 0 : $centerX;
    $centerY = CEIL(($height - $text_height) / 2);
    $centerY = $centerY<0 ? 0 : $centerY;

    //print course title at center of x axis
    //imagettftext($image, 42, 0, $centerX, 1225, $color, "./ROBOTO-BOLD.TTF", $row['crt_course_name']);

    imagettftext($image,23,0,1580,462,$color,$font,$row['student_roll']);
    imagettftext($image,23,0,1580,533,$color,$font,$row['student_registration']);
    imagettftext($image,23,0,1590,605,$color,$font,date("d/m/Y"));


    imagettftext($image,25,0,820,670,$color,$font,ucwords(strtolower($student['student_name'])));
    imagettftext($image,25,0,740,755,$color,$font,ucwords(strtolower($student['father_name'])));
    imagettftext($image,25,0,1400,755,$color,$font,ucwords(strtolower($student['mother_name'])));
    imagettftext($image, 25, 0, 940, 840, $color, $font, ucwords(strtolower($course['crt_course_name'])));
    imagettftext($image,25, 0, 780, 925,$color,$font,ucwords(strtolower($branch['branch_name'])));
    imagettftext($image,25,0,1690,930,$color,$font,$branch['branch_code']);
    //imagettftext($image,30,0,1550,2125,$color,$font,$row['session_name']);
    imagettftext($image,25,0,700,1010,$color,$font,$session_start_month.', '.$session['session_start_year']);
    imagettftext($image,25,0,1080,1010,$color,$font,$session_end_month.', '.$session['session_end_year']);
    imagettftext($image,25,0,1630,1015,$color,$font,$grade);


    //student photo
    $student_image=imagecreatefrompng($student['student_image']);
    list($width,$height) = getimagesize($student['student_image']);
    //imagecopymerge($image, $student_image, 1700, 1400, 0, 0, $width, $height, 100);
    //imagecopyresized($image, $student_image, 1700, 1400, 0, 0, $width*2, $height*2, $width, $height);

    //authorization seal
    $seal_image=imagecreatefrompng("Seal.png");
    list($width,$height) = getimagesize("Seal.png");
    //imagecopy($image, $seal_image, 1580, 1200, 0, 0, $width, $height);


    //head of the institute signature
    $sign_image = imagecreatefrompng("Chairman-Sign.png");
    list($width,$height) = getimagesize("Chairman-Sign.png");
    imagecopy($image, $sign_image, 1560, 1165, 0, 0, $width, $height);
    //imagecopymerge($image, $sign_image, 1200, 2500, 0, 0, $width, $height, 100);
    //imagecopyresized($image, $sign_image, 1200, 2440, 0, 0, $width*2, $height*2, $width, $height);

    //MD signature
    $sign_image = imagecreatefrompng("MD-Sign.png");
    list($width,$height) = getimagesize("MD-Sign.png");
    //imagecopy($image, $sign_image, 1150, 1230, 0, 0, $width, $height);
    imagecopyresized($image, $sign_image, 1090, 1185, 0, 0, $width*2/3, $height*2/3, $width, $height);


    $file=time().'_'.$row['student_id'];
    $file_path="registration/".$file.".png";
    $file_path_pdf="registration/".$file.".pdf";
    imagepng($image);
    imagedestroy($image);


    //unlink($file_path);

//    echo 'certificate of -'.$row['student_name'].'- created successfully!';
//
//
//    //echo 'Done';
//}else{
//    echo '<h1 style="text-align: center; color: red;">Student Not Found!</h1>';
}
?>
