
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    @include('admin.include.style')

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="{{asset('admin-assets')}}/images/logo.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>User Name</label>
                        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{old('password')}}">
                        @error('password')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation @error('password') confirmation is-invalid @enderror" class="form-control" placeholder="Password" value="{{old('password_confirmation')}}">
                        @error('password_confirmation')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Agree the terms and policy
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.include.script')

</body>
</html>
