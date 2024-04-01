
<!doctype html>
{{--<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->--}}
{{--<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->--}}
{{--<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->--}}
{{--<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
{{--    <meta name="description" content="Ela Admin - HTML5 Admin Template">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php $logo = getSettings('site_logo') @endphp
    <link rel="apple-touch-icon" href="{{asset($logo)}}">
    <link rel="shortcut icon" href="{{asset($logo)}}">
    @include('admin.include.style')
</head>

<body>
<!-- Left Panel -->
@include('admin.include.sidenavbar')
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
   @include('admin.include.header')
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        @yield('content')
        <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    @include('admin.include.footer')
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

@include('admin.include.script')
</body>
</html>
