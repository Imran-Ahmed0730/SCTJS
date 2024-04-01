<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Branch Result Sheet</title>
{{--    <style>--}}
{{--        @font-face {--}}
{{--            font-family: 'SutonnyMJ';--}}
{{--            font-style: normal;--}}
{{--            font-weight: normal;--}}
{{--            src: url({{asset('/')}}admin-assets/font/SutonnyMJ.TTF) format('truetype');--}}
{{--        }--}}

{{--        .bangla-title {--}}
{{--            font-family: 'SutonnyMJ', sans-serif;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>
<table width="700px" align="center">
    <tr height="100px">
        <td width="150px" align="left">
            @php $logo = getSettings('site_logo'); @endphp
            <img src="data:image/jpg;base64,{{base64_encode(file_get_contents($logo))}} "  height="150px" width="150px">
{{--            <img src="{{asset('/')}}admin-assets/images/logo.jpg" height="150px" width="150px" alt="">--}}
        </td>
        <td width="400px">
            <div align="center">
{{--                <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/result-header.jpg')))}} "  width="400px" height="50px" alt="">--}}
{{--                <img src="{{asset('/')}}/admin-assets/images/result-header.jpg" width="400px" height="50px" alt="">--}}
{{--                <h1 style="margin:0; color: blue" class="bangla-title">দক্ষ যুব আইসিটি উন্নয়ন</h1>--}}
                <h2 style="margin:0 ">{{getSettings('site_name')}}</h2>
                <p style="margin: 0"><a href="{{getSettings('site_url')}}" style="text-decoration: none; color: black">{{getSettings('site_url')}}</a></p>
            </div>
        </td>
        <td width="150px" align="right">
            <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/qr_code.jpg')))}} "   height="90px" width="90px">
{{--            <img src="{{asset('/')}}admin-assets/images/qr_code.jpg" height="90px" width="90px" alt="">--}}
        </td>
    </tr>
</table>
<table cellspacing="10" cellpadding="3" align="left">
    <tr>
        <td><strong>Branch Code </strong></td><td >:</td>
        <td >{{$branch->branch_code ?? ''}}</td>
    </tr>
    <tr>
        <td><strong>Branch Name </strong></td><td>:</td>
        <td >{{$branch->branch_name ?? ''}}</td>
    </tr>
    <tr>
        @if(isset($_GET['course_id']) && $_GET['course_id'] > 0)
            @php $course = \App\Models\Course::find($_GET['course_id']) @endphp
        <td><strong>Course Name </strong></td><td>:</td>
        <td>{{$course->course_name}}</td>
        @elseif(isset($_GET['session_id']) && $_GET['session_id'] >0)
            @php $session = \App\Models\Session::find($_GET['session_id']) @endphp
        <td><strong>Session Name </strong></td><td>:</td>
        <td>{{$session->session_name}}</td>
        @endif
    </tr>

</table>
<table border="1" style="text-align: left; border-collapse: collapse;" cellpadding="3">
    <tr align="left">
        <th>#</th>
        <th align="left">Student Name</th>
        <th>Roll No</th>
        <th>Registration No</th>
        <th>Course Name</th>
        <th>Marks</th>
        <th>Grade</th>
    </tr>
    @php $i=1 @endphp
    <tbody>
    @foreach($items as $item)
        @php $course=getCourseById($item->course_id) @endphp
        <tr>
            <th>{{$i++}}.</th>
            <td>{{$item->student->student_name}}</td>
            <td>{{$item->student_roll}}</td>
            <td>{{$item->student_registration}}</td>
            <td>{{$course!=null ? $course->course_name:''}}</td>
            <td align="center">{{$item->result_marks }}</td>
            <td align="center">{{$item->result_grade_id != null ? $item->resultGrade->result_grade_title:''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
