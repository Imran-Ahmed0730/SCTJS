@extends('frontend.master')
@section('title')
    Resources
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Resources</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item text-light">/</li>
                            <li class="breadcrumb-item text-light active" aria-current="page">Resources</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Register Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row d-flex flex-column-reverse flex-lg-row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h3>Get In Touch</h3>
                    {{--                    <p class="contact-text mb-4 mt-4">The contact form is currently inactive. Get a functional and working contact--}}
                    {{--                        form--}}
                    {{--                        with Ajax & PHP in a few minutes. Just copy and paste the files, add a little text and you're--}}
                    {{--                        done.--}}
                    {{--                    </p>--}}
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">{{getSettings('Address')}}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">{{getSettings('Phone1')}}</p>
                            <p class="mb-0">{{getSettings('Phone2')}}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                             style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">{{getSettings('email')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                    <h3>Resources</h3>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Office Application</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Database Programing</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Admission form</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Application form</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Jubo Unnayan Banner For Branch</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="#">Computer Related Bangla Question With Answer</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
@endsection
