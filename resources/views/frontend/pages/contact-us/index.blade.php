@extends('frontend.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Contact Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item text-light">/</li>
                            <li class="breadcrumb-item  text-light active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
                <h4 class="text-success">{{session('message')}}</h4>
            </div>
            <div class="row g-4">
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
                <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="{{route('user.message.send')}}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="message"
                                              style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <div class="wow fadeInUp" data-wow-delay="0.3s">
        <iframe class="position-relative rounded w-100 h-100"
                src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d3659.0366490424976!2d89.4145533!3d23.4951894!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x39fe56146537367b%3A0x4d5d0ecf79d9c081!2zTWFndXJhIEthbGkgQmFyaSDgpq7gpr7gppfgp4HgprDgpr4g4KaV4Ka-4Kay4KeAIOCmrOCmvuCnnOCmvyBGQ1c3KzNSRiBNYWd1cmEgQmFuZ2xhZGVzaA!3m2!1d23.495189699999997!2d89.41455049999999!5e0!3m2!1sen!2sbd!4v1706096019442!5m2!1sen!2sbd"
                frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
    </div>
@endsection
