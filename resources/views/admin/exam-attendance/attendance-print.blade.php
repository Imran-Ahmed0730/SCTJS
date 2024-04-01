<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            #summary-table tr th{
                text-align: left !important;
            }
        </style>
    </head>
    <body>
    <div align="center">
        <table width="700px" align="center">
            <tr height="100px">
                <td width="150px" align="left">
                    <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/logo.jpg')))}} "  height="150px" width="150px">
                    {{--            <img src="{{asset('/')}}admin-assets/images/logo.jpg" height="150px" width="150px" alt="">--}}
                </td>
                <td width="400px">
                    <div align="center">
{{--                        <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/result-header.jpg')))}} "  width="400px" height="50px" alt="">--}}
                        {{--                <img src="{{asset('/')}}/admin-assets/images/result-header.jpg" width="400px" height="50px" alt="">--}}
                        {{--                <h1 style="margin:0; color: blue" class="bangla-title">দক্ষ যুব আইসিটি উন্নয়ন</h1>--}}
                        <h3 style="margin:0 ">{{getSettings('site_name')}}</h3>
                        <p style="margin: 0"><a href="#" style="text-decoration: none; color: black">www.example.com</a></p>
                    </div>
                </td>
                <td width="150px" align="right">
                    <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/qr_code.jpg')))}} "   height="90px" width="90px">
                    {{--            <img src="{{asset('/')}}admin-assets/images/qr_code.jpg" height="90px" width="90px" alt="">--}}
                </td>
            </tr>
        </table>
        <table id="summary-table" cellspacing="10" cellpadding="5" border="0" width="700px" style="border-collapse: collapse; margin-bottom: 20px">
            <tr>
                <th width="100px">Exam Date:</th>
                <td colspan="2">{{$exam->date}}</td>
            </tr>
            <tr>
                <th width="100px">Branch Name:</th>
                <td colspan="2">{{$exam->branch->branch_name}}</td>
            </tr>
            <tr>
                <th width="100px">Course Name:</th>
                <td colspan="2">{{$exam->course->course_name}}</td>
            </tr>
            <tr>
                <th width="100px">Session Name:</th>
                <td colspan="2">{{$exam->session->session_name}}</td>
            </tr>
            <tr style="text-align: left">
                <td width="150"><strong>Total Students:</strong> {{$exam->total_student}}</td>
                <td><strong>Present: </strong>{{$exam->present}}</td>
                <td><strong>Absent: </strong>{{$exam->absent}}</td>
            </tr>
        </table>
        <table cellspacing="10" cellpadding="5" border="1" style="border-collapse: collapse; margin-bottom: 10px; text-align: center" width="700px">
            <thead>
            <th>#</th>
            <th>Student Name</th>
            <th>Student Roll</th>
            <th>Status</th>
            </thead>
            <tbody>
            @if($items)
                @php $i=1 @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->student->student_name ?? ''}}</td>
                        <td>{{$item->branchStudent->student_roll ?? ''}}</td>
                        <td>{{$item->status == 1 ? 'Present': 'Absent'}}</td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="4">No Student</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    </body>
    </html>
