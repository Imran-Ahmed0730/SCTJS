<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$item->student->student_name}} Marksheet</title>
{{--    <style>--}}
{{--        /*@import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');*/--}}
{{--        body{--}}
{{--            margin: auto;--}}
{{--        }--}}
{{--        .card-border{--}}
{{--            height: 1030px;--}}
{{--            width: 700px;--}}
{{--            padding-right: 10px;--}}
{{--            margin: auto;--}}
{{--            background-image: url("{{asset('/')}}/admin-assets/images/MarkSheet Banner back.jpg");--}}
{{--            background-position: center;--}}
{{--            background-repeat: no-repeat;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>
    <div align="center" class="card-border">
       <div >
           <table height="150px" width="600px" align="center" style="margin-top: 60px">
               <tr height="150px" valign="top">
                   <td width="100px" align="left">
                       <strong style="font-size: 14px">Serial Number:</strong>
                   </td>
                   <td width="360px">
                       <div align="center">
                           @php $logo = getSettings('site_logo') @endphp
                           <img src="data:image/png;base64,{{base64_encode(file_get_contents($logo))}} " height="120px" width="120px" alt="">
{{--                           <img src="{{asset('/')}}admin-assets/images/transparent-logo.png" height="150px" width="150px" alt="">--}}
                           <h3 style="margin:0 ">{{getSettings('site_name')}}</h3>
                           <p style="margin: 0; color: blue; font-size: 12px">Approved by Government of People's Republic of Bangladesh </p>
                       </div>
                   </td>
                   <td width="90px" align="right">
                       <img src="data:image/jpg;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/qr_code.jpg')))}} "   height="90px" width="90px">
                   </td>
               </tr>
               <tr height="50px">
                   <td colspan="3">
                       <h3 style="text-align: center"><strong style="padding: 5px 10px; background-color:  rgb(193,0,22); border-radius: 20px; color: white">Marksheet</strong></h3>
                   </td>
               </tr>
           </table>
           <table border="1" style="position: relative;" cellspacing="10" cellpadding="2" align="center" width="600px" height="160px">
               <tr style="height:20px;">
                   <td><strong>Student Name </strong></td><td width="10px">:</td>
                   <td colspan="3">{{$item->student->student_name}}</td>
                   <td style="position: absolute; " rowspan="6" width="150px" align="right">
                       @if($item->student->student_image)
{{--                           <img src="data:image/png;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/transparent-logo.png')))}} " height="150px" width="150px" alt="">--}}

                           <img src="data:image/jpg;base64,{{base64_encode(file_get_contents($item->student->student_image))}} "   height="90px" width="90px">
{{--                           <img src="{{'public/'.asset($item->student->student_image)}}" style="height: 120px; width: 120px;" alt="No Image">--}}
                       @else
                           <div align="center">No Image</div>
                       @endif
                   </td>
               </tr>

               <tr style="height:20px;">
                   <td width="100px"><strong>Father's Name </strong></td><td width="10px">:</td>
                   <td colspan="3">{{$item->student->father_name}}</td>
               </tr>
               <tr style="height:20px;">
                   <td  width="100px"><strong>Mother's Name </strong></td><td width="10px">:</td>
                   <td colspan="3">{{$item->student->mother_name}}</td>
               </tr>
               <tr style="height:20px;">
                   <td width="100px"><strong>Date of Birth </strong></td><td width="10px">:</td>
                   <td colspan="3">{{$item->student->student_dob}}</td>
               </tr>
               <tr style="height:20px;">
                   <td width="100px"><strong>Branch Name </strong></td><td width="10px">:</td>
                   <td  colspan="4">{{$item->branch->branch_name}}</td>
               </tr>
               <tr style="height:20px;">
                   <td width="120px"><strong>Session </strong></td><td width="10px">:</td>
                   <td colspan="4">{{$item->session->session_name}}</td>
               </tr>
               <tr style="height:20px;">
                   <td width="100px"><strong>Roll No</strong></td><td width="10px">:</td>
                   <td colspan="">{{$item->student_roll}}</td>
                   <td width="100px"><strong>Reg No</strong></td><td>:</td>
                   <td colspan="2">{{$item->student_registration}}</td>
               </tr>
               <tr style="height:20px;">
                   <td width="100px"><strong>Course Name </strong></td><td width="10px">:</td>
                   <td colspan="">{{$item->course->course_name}}</td>
                   <td width="100px"><strong>Course Code </strong></td><td width="10px">:</td>
                   <td colspan="">{{$item->course->course_code}}</td>
               </tr>

           </table>

           <table border="1" width="600px" style="border-collapse: collapse; margin-top: 10px" align="center"  height="150px">
               <tr>
                   <th>SL No</th>
                   <th>Module Name</th>
                   <th>Total Marks</th>
                   <th>Obtained Marks</th>
               </tr>
               @php $i=1 @endphp
               @foreach($results as $result)
                   <tr style="text-align: center">
                       <td>{{$i<= 9 ? '0':''}}{{$i++}}</td>
                       <td>{{$result->courseModule->module_name}}</td>
                       <td>100</td>
                       <td>{{$result->marks}}</td>
                   </tr>
               @endforeach
               <tr height="25px">
                   <td colspan="3" align="right" style="padding-right: 20px"><strong>Percentage</strong></td>
                   <td style="text-align:center">{{$item->result_marks}}</td>
               </tr>
               <tr height="25px" >
                   <td colspan="3" align="right" style="padding-right: 20px"><strong>Grade</strong></td>
                   <td style="text-align:center">{{$item->result_grade_id != null ? $item->resultGrade->result_grade_title:''}}</td>
               </tr>
           </table>
           <table cellspacing="10" cellpadding="3" align="center" width="600px" height="475px">
               <tr height="25px">
                   <td colspan="3"><strong style="padding-left: 10px">Date of Issue:</strong><span style="margin-left: 10px">{{date('d-m-Y')}}</span></td>

               </tr>

               <tr style="text-align: center; font-size: 14px;  height: 250px">
                   <td style="padding-top: 130px">
{{--                       <img src="data:image/png;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/Chairman-Sign.png')))}} " height="100px" width="200px" alt="">--}}

{{--                       <img src="{{asset('admin-assets')}}/images/Chairman-Sign.png" height="100px" width="200px" alt="">--}}
                       ______________________
                       <strong>Chairman/Director</strong>
                   </td>
                   <td style="padding-top: 130px">
{{--                       <img src="data:image/png;base64,{{base64_encode(file_get_contents(base_path('public/admin-assets/images/ExamController.png')))}} " height="100px" width="200px" alt="">--}}

{{--                       <img src="{{asset('admin-assets')}}/images/ExamController.png" height="100px" width="200px" alt="">--}}
                       ______________________
                       <strong>Controller of Examination</strong>
                   </td>
                   <td style="padding-top: 130px">
                       ______________________
                       <strong>Regional Director</strong>
                   </td>
               </tr>
           </table>
       </div>
    </div>
</body>
</html>
