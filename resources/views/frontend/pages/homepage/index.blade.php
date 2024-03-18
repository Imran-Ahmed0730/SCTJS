@extends('frontend.master')
@section('title')
    Home
@endsection
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{asset('frontend-assets')}}/img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                     style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown">The Best Online Learning Platform
                                </h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                    stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                    eirmod elitr.</p>
                                <a href="#" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="{{route('branch.apply')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{asset('frontend-assets')}}/img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                     style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your Home
                                </h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed
                                    stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus
                                    eirmod elitr.</p>
                                <a href="#" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                    More</a>
                                <a href="#" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h2 class="mb-3">{{$studentCount}}+</h2>
                            <h5>Students</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h2 class="mb-3">{{count($courses)}}</h2>
                            <h5>Courses</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home text-primary mb-4"></i>
                            <h2 class="mb-3">{{count($branches)}}</h2>
                            <h5>Branches</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h2 class="mb-3">2000+</h2>
                            <h5>Visitors</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{asset('frontend-assets')}}/img/About-us.jpg" alt=""
                             style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">দক্ষ যুব আইসিটি উন্নয়ন</h1>
                    <p class="mb-4">দেশ থেকে বেকারত্ব দূর করা সকলের দায়িত্ব শুধু সরকারের নয়। এরই লক্ষ্যে বাস্তবসম্মত
                        এবংযুগোপযোগী শিক্ষার আলোই আলোকিত করে দেশের উদীয়মান জনশক্তির জন্য স্বপ্নীল ভবিষ্যৎ গড়ে তোলা
                        আমাদের অঙ্গীকার। কিন্তু আমাদের দেশে তৃর্ণমূলপর্যায়ে এখনও প্রত্যাশিতভাবে কম্পিউটার শিক্ষা চালু
                        হয়নি। আমরা প্রতিটি জেলা ও থানা পর্যায়ে একটি করে আধুনিক কম্পিউটার ট্রেনিং সেন্টার চালু করার
                        উদ্যোগগ্রহণ করেছি।
                    </p>
                    <p class="mb-4">আইসিটিতে তরুণ উদ্যোক্তা সৃষ্টি এবং তাদের মাধ্যমে দক্ষ জনশক্তি তৈরি এবং
                        ডিজিটাল বাংলাদেশ গড়ার লক্ষ্যে বিভিন্ন বিষয়ে প্রশিক্ষণ দিয়ে বেকারমুক্ত বাংলাদেশ গড়ে তুলবো
                        ইনশাল্লাহ।
                    </p>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="#">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Our Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($courses as $key=>$course)
                    @if($key == 28)
                        @php break; @endphp
                    @endif
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                @if($course->image == null)
                                    <img class="img-fluid" src="{{asset('frontend-assets')}}/img/courses/3D Studio Max.jpg" alt="">
                                @else
                                    <img class="img-fluid" src="{{asset($course->image)}}" alt="">
                                @endif
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                       style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                       style="border-radius: 0 30px 30px 0;">Join Now</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <div class="mb-3">
                                    <h5 class="mb-4">{{Str::limit($course->course_name, 15, '...')}}</h5>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(123)</small>
                                </div>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{$course->total_lectures}}</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{count(getStudentsByCourseId($course->id))}}
                                    Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('frontend-assets')}}/img/team-1.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('frontend-assets')}}/img/team-2.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('frontend-assets')}}/img/team-3.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{asset('frontend-assets')}}/img/team-4.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href="#"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!--Feature One Start-->
    <section class="feature-one">
        <div class="container-lg">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3">Thank you Prime Minister</h1>
                <h6>Digital World-2017 Inauguration Ceremony, BICC, Dhaka, Wednesday, 06 December, 2017</h6>
                <h6 class="section-title bg-white text-center text-primary px-3">...............</h6>
            </div>
            <div class="row mt-5">
                <div class="col-xl-6 col-lg-6  wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <img class="feature-one-img" src="{{asset('frontend-assets')}}/img/feature/prime-minister.jpg" alt="">
                </div>
                <div class="col-xl-6 col-lg-6 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="feature-one__single feature-one-text-box">
                        <div class="feature-one__single-bg" style="background-image: url({{asset('frontend-assets')}}/img/feature-one-shape-1.png);">
                        </div>
                        <div>
                            <h6 class="text-light">
                                “Since 2011, we have compulsory ICT Education at the ‘to Secondary level. As well as
                                setting
                                up Computer Labs and Digital Classroom in Educational Institutions, Digital converting
                                education materials and textbooks are being done. The country’s training program is
                                being
                                strengthened. For this reason about 50 thousand boys and girls are being trained by the
                                Department of Information and Communication Technology. Robotics, Big data, Internet of
                                Things, Data Analytics Labs is being developed in the Universities”.
                            </h6>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-light">Sheikh Hasina</h3>
                            <h6 class="text-light">Prime Minister</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Feature One End-->

    <!--Feature Two Start-->
    <section class="feature-two">
        <div class="container-lg">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3">Chairman’s Speech</h1>
                <h6 class="section-title bg-white text-center text-primary px-3">...............</h6>
            </div>
            <div class="row mt-5">
                <div class="col-xl-6 col-lg-6  wow slideInLeft" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <div class="feature-two__single feature-two-text-box">
                        <div class="feature-one__single-bg" style="background-image: url({{asset('frontend-assets')}}/img/feature-one-shape-1.png);">
                        </div>
                        <div class="text-light">
                            <p>
                                বাংলাদেশে তথ্য প্রযুক্তির নতুন দিগন্ত দক্ষ যুব আইসিটি উন্নয়ন। বাংলাদেশ তথ্য প্রযুক্তি
                                সেক্টরে ১ কোটি মানুষের কর্মসংস্থান সৃষ্টির লক্ষে দক্ষ যুব আইসিটি উন্নয়ন ২০২০ সাল থেকে
                                The Companies ACT XVIII OF 1994 এর আওতায় সেবামূলক কাজের জন্য সরকারি অনুমোদন নিয়ে দেশের
                                বহু বেকার তরুণ তরুণীদের তথ্যপ্রযুক্তি ভিত্তিক শিক্ষা প্রদানের মাধ্যমে আই সি টি শিক্ষায়
                                শিক্ষত করে দেশের বহু বেকার যুবকের আত্ম-কর্মসংস্থানের পথ দেখিয়ে যাচ্ছে। দেশ থেকে বেকারত্ব
                                দূর করা শুধু সরকারের দায়িত্ব নয়। এই লক্ষে আমাদের দক্ষ যুব আইসিটি উন্নয়ন বাস্তবসম্মত
                                শিক্ষার আলোয় আলোকিত করে দেশের জনশক্তির জন্য স্বপ্নীল ভবিষ্যৎ গড়ে তোলাও বেকার মুক্ত করা
                                আমাদের অঙ্গীকার। কিন্তু আমাদের দেশে তৃণমূল পর্যায়ে এখনোও প্রত্যাশিত ভাবে ঘরে ঘরে
                                কম্পিউটার শিক্ষা চালু হয়নি। আমরা প্রতিটি জেলা ও থানা এবং ইউনিয়ন পর্যায়ে একটি করে আধুনিক
                                কম্পিউটার ট্রেনিং সেন্টর চালু করার উদ্যোগ গ্রহণ করেছি। আইসিটিতে তরুণ উদ্যোক্তা সৃষ্টি
                                করে তাদের মাধ্যমে দক্ষ জনশক্তি এবং তথ্য প্রযুক্তির মাধ্যমে বাংলাদেশকে বিশ্বের সাথে তাল
                                মিলিয়ে এগিয়ে নিয়ে যাব। আইসিটির বিষয়সমূহ ছাড়াও আমরা আরও কর্মসংস্থান সৃষ্টির লক্ষে দক্ষ
                                যুব আইসিটি উন্নয়ন এ ড্রেস মেকিং এন্ড টেইলারিং, ফুড প্রসেসিং এন্ড প্রিজারভেশন,
                                সার্টিফিকেট ইন বিউটিফিকেশন, বক্স মেকিং এন্ড প্যাকেজিং কোর্স চালু করাসহ বাংলাদেশকে
                                বেকারমুক্ত করার জন্য কাজ করে যাচ্ছি।
                            </p>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-light">চেয়ারম্যান</h3>
                            <h6 class="text-light">দক্ষ যুব আইসিটি উন্নয়ন</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6  wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                    <img class="feature-two-img" src="{{asset('frontend-assets')}}/img/Chairman.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--Feature Two End-->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend-assets')}}/img/testimonial-1.jpg"
                         style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend-assets')}}/img/testimonial-2.jpg"
                         style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend-assets')}}/img/testimonial-3.jpg"
                         style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend-assets')}}/img/testimonial-4.jpg"
                         style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                            eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
