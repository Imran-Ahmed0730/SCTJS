<!-- Navbar Start -->
@php $route = Route::current()->getName(); @endphp
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img style="width: 60px;" src="{{asset(getSettings('site_logo'))}}" alt="">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{route('home')}}" class="nav-item nav-link {{$route =='home' ? 'active':'' }}">Home</a>
            <a href="{{route('branch.apply')}}" class="nav-item nav-link {{$route =='branch.apply' ? 'active':'' }}">Apply For Branch</a>
            <a href="{{route('exam.results')}}" class="nav-item nav-link {{$route =='exam.results' ? 'active':'' }}">Exam Result</a>
            <a href="{{route('courses')}}" class="nav-item nav-link {{$route =='courses' ? 'active':'' }}">Courses</a>
            <a href="{{route('gallery')}}" class="nav-item nav-link {{$route =='gallery' ? 'active':'' }}">Gallery</a>
            <a href="{{route('resources')}}" class="nav-item nav-link {{$route =='resources' ? 'active':'' }}">Resources</a>
            <a href="{{route('contact')}}" class="nav-item nav-link {{$route =='contact' ? 'active':'' }}">Contact Us</a>
            <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> -->
        </div>
        <div class="nav-item dropdown d-block d-lg-none">
            <a href="{{route('branches.all')}}" class="nav-link py-4 mx-2 mobile-join-btn" data-bs-toggle="dropdown">Our Branches <i
                    class="fa fa-arrow-right ms-3"></i></a>
            <div class="dropdown-menu fade-down m-0">
                <a href="{{route('branches.all')}}" class="dropdown-item">All Branch <i class="fa fa-arrow-right ms-3"></i></a>
                <hr>
                <a href="{{route('login')}}" class="dropdown-item">Branch Login <i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
        <div class="nav-item dropdown d-none d-lg-block">
            <a href="#" class="btn btn-primary py-4 px-4 nav-link " data-bs-toggle="dropdown">Our Branches <i
                    class="fa fa-arrow-right ms-3"></i></a>
            <div class="dropdown-menu fade-down m-0">
                <a href="{{route('branches.all')}}" class="dropdown-item">All Branch <i class="fa fa-arrow-right ms-3"></i></a>
                <hr>
                <a href="{{route('login')}}" class="dropdown-item">Branch Login <i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
