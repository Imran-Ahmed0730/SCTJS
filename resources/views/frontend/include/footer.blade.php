<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <a href="{{route('home')}}"
                   class="navbar-brand d-flex justify-content-center justify-content-lg-start align-items-center px-4">
                    <img style="width: 200px;" src="{{asset('frontend-assets')}}/img/logo/Logo-white.png" alt="logo">
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Quick Links</h4>
                <a class="btn btn-link" href="{{route('home')}}">Home</a>
                <a class="btn btn-link" href="{{route('about.us')}}">About Us</a>
                <a class="btn btn-link" href="{{route('courses')}}">Our Courses</a>
                <a class="btn btn-link" href="{{route('contact')}}">Contact Us</a>
                <a class="btn btn-link" href="{{route('privacy-policy')}}">Privacy & Policy</a>
                <a class="btn btn-link" href="{{route('terms-conditions')}}">Terms & Condition</a>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{getSettings('Address')}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{getSettings('Phone1')}}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{getSettings('Phone2')}}</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{getSettings('email')}}</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="d-flex justify-content-center justify-content-lg-start align-items-center">
                    <img style="width: 260px;" src="{{asset('frontend-assets')}}/img/logo/Sign-Name.png" alt="logo">
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start align-items-center mt-4">
                    <p>We Accept</p>
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start align-items-center">
                    <button type="button" class="me-2"><img style="width: 50px;" src="{{asset('frontend-assets')}}/img/logo/Untitled-1.jpg"
                                                            alt="payment_logo"></button>
                    <button type="button" class="me-2"><img style="width: 50px;" src="{{asset('frontend-assets')}}/img/logo/Untitled-2.jpg"
                                                            alt="payment_logo"></button>
                    <button type="button"><img style="width: 50px;" src="{{asset('frontend-assets')}}/img/logo/Untitled-3.jpg"
                                               alt="payment_logo"></button>
                </div>

                <div class="d-flex justify-content-center justify-content-lg-start align-items-center mt-3">
                    <a href="{{route('branch.apply')}}" class="btn btn-primary py-2 px-4 border mt-2 me-2">Apply For
                        Branch</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-7 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="{{route('home')}}">{{getSettings('site_name')}}</a> || All Right
                    Reserved.

                    Designed By || <a class="border-bottom" href="https://skydreamit.com/">Sky Dream IT</a>
                </div>
                <div class="col-md-5 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('cookies')}}">Cookies</a>
                        <a href="{{route('help')}}">Help</a>
                        <a href="#">FQAs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
