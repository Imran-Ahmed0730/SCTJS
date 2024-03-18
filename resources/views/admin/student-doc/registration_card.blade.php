<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="data:image/jpg;base64,{{base64_encode(file_get_contents('uploads/registration/Reg-Card'.$student->student_id.'.png'))}}" style="margin: -50px" align="center" width="805px"  height="1130px">
</body>
</html>
