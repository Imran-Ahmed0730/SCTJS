
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login to Dashboard</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('admin-assets')}}/images/{{getSettings('site_icon')}}">
    <link rel="shortcut icon" href="{{asset('admin-assets')}}/images/{{getSettings('site_icon')}}">

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
                        <img class="align-content" src="{{asset('admin-assets')}}/images/login-logo.png" alt="" height="250" width="250px">
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="{{route('admin.login')}}">
                        @csrf
                        <div class="form-group">
                            <label>Email Address or Branch Code</label>
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email or Branch Code">
                            @error('email')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
{{--                            <label class="pull-right">--}}
{{--                                <a href="#">Forgotten Password?</a>--}}
{{--                            </label>--}}

                        </div>
                        <button type="submit" class="btn btn-warning btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.include.script')
</body>
</html>

