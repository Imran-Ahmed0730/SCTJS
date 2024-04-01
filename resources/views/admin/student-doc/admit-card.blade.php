<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$item->student->student_name}} Admit Card</title>
</head>
<body>
    <table border="0" width="700px" align="center">
        <tr height="100px">
            <td width="150px" align="left">
                <img src="data:image/jpg;base64,{{base64_encode(file_get_contents('frontend-assets/img/logo/site_logo.png'))}} "   height="150px" width="150px">

{{--                <img src="{{asset('/')}}admin-assets/images/logo.jpg" height="150px" width="150px" alt="">--}}
            </td>
            <td width="400px">
                <div align="center">
{{--                    <img src="data:image/jpg;base64,{{base64_encode(file_get_contents('admin-assets/images/result-header.jpg'))}} "   width="400px" height="50px">--}}
{{--                    <img src="{{asset('/')}}/admin-assets/images/result-header.jpg" width="400px" height="50px" alt="">--}}
                    <h2 style="margin:0 ">{{getSettings('site_name')}}</h2>
                    <p style="margin: 0"><a href="{{getSettings('site_url')}}" style="text-decoration: none; color: black">{{getSettings('site_url')}}</a></p>
                </div>
            </td>
            <td width="150px" align="right">
                <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/qr_code.jpg')))}} "   height="90px" width="90px">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table cellspacing="10" cellpadding="3" align="left" width="550px">
                    <tr>
                        <td><strong>Student Name </strong></td><td width="10px">:</td>
                        <td>{{$item->student->student_name}}</td>
                    </tr>

                    <tr>
                        <td><strong>Roll No</strong></td><td width="10px">:</td>
                        <td>{{$item->student_roll}}</td>
                    </tr>
                    <tr>
                        <td><strong>Registration Number</strong></td><td>:</td>
                        <td>{{$item->student_registration}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch Name </strong></td><td width="10px">:</td>
                        <td >{{$item->branch->branch_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Course Name </strong></td><td width="10px">:</td>
                        <td>{{$item->course->course_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Session </strong></td><td width="10px">:</td>
                        <td>{{$item->session->session_name}}</td>
                    </tr>

                </table>
            </td>
            <td valign="top" width="150px">
                @if($item->student->student_image)
                    <img align="right" src="data:image/jpg;base64,{{base64_encode(file_get_contents($item->student->student_image))}} " width="120px" height="120px">
{{--                    <img src="{{asset($item->student->student_image)}}" height="150px" width="150px" alt="No Image">--}}
                    @else
                <div align="center">No Image</div>
                    @endif
            </td>
        </tr>
    </table>
</body>
</html>
