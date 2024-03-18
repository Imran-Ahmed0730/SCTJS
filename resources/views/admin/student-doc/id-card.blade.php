<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$item->student->student_name}} ID Card</title>
</head>
<body>
    <table border="1" width="200px" align="center">
        <tr>
            <td>
{{--                    <img src="data:image/jpg;base64,{{base64_encode(file_get_contents('admin-assets/images/result-header.jpg'))}} "   width="400px" height="50px">--}}
{{--                    <img src="{{asset('/')}}/admin-assets/images/result-header.jpg" width="400px" height="50px" alt="">--}}
                    <h4 style="color: blue; text-align: center; margin: 0">{{$item->branch->branch_name}}</h4>
{{--                    <p style="margin: 0"><a href="https://www.bdyouthict.com" style="text-decoration: none; color: black">www.bdyouthict.com</a></p>--}}

            </td>
        </tr>
        <tr>
            <td>
                @if($item->student->student_image)
                    <img  src="data:image/jpg;base64,{{base64_encode(file_get_contents($item->student->student_image))}} " width="80px" height="90px" style="margin: 5px 85px">
                    {{--                    <img src="{{asset($item->student->student_image)}}" height="150px" width="150px" alt="No Image">--}}
                @else
                    <div align="center">No Image</div>
                @endif
            </td>
        </tr>
        <tr>
            <td width="200px">
                <table border="0" cellpadding="2" cellspacing="" width="250px"  align="center" style="font-size: 12px; text-align: center;">

                    <tr>

                        <td colspan="3">{{$item->student->student_name}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">{{$item->course->course_name}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">{{$item->session->session_name}}</td>
                    </tr>

                    <tr style="text-align: justify; ">
                        <td ><strong>Roll</strong></td>
                        <td width="10px">:</td>
                        <td>{{$item->student_roll}}</td>
                    </tr>
                    <tr style="text-align: justify">
                        <td><strong>Registration</strong></td>
                        <td>:</td>
                        <td >{{$item->student_registration}}</td>
                    </tr>
                    <tr height="30px">
                        <td colspan="3" style="padding-top: 20px">
                            <img src="data:image/jpg;base64,{{base64_encode(file_get_contents('admin-assets/images/result-header.jpg'))}} " style="transform: scale(0.6)"   width="200px" height="50px"><br>
                            {{--                    <img src="{{asset('/')}}/admin-assets/images/result-header.jpg" width="400px" height="50px" alt="">--}}
{{--                            <small style="color: blue; text-align: center; margin: 0">Expert Youth ICT Developement</small>--}}
{{--                            <br>--}}
{{--                            <small style="margin: 0"><a href="https://www.bdyouthict.com" style="text-decoration: none; color: black">www.bdyouthict.com</a></small>--}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
