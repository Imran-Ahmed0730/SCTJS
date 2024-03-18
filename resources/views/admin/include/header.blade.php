<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('admin.dashboard')}}"><img src="{{asset('admin-assets')}}/images/{{ getSettings('site_logo')  }}" alt="Logo" height="43px"></a>
            <a class="navbar-brand hidden" href="{{route('admin.dashboard')}}"><img src="{{asset('admin-assets')}}/images/logo21.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
{{--                <button class="search-trigger"><i class="fa fa-search"></i></button>--}}
{{--                <div class="form-inline">--}}
{{--                    <form class="search-form">--}}
{{--                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">--}}
{{--                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>--}}
{{--                    </form>--}}
{{--                </div>--}}

            </div>

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong class="mx-2">Expert Youth ICT Development ({{Auth::user()->name}})</strong>
                    <img class="user-avatar rounded-circle" src="{{asset('admin-assets')}}/images/default.jpg" alt="User Avatar">
                </a>


                <div class="user-menu dropdown-menu">
                    @if(Auth::user()->role == 2)
                        <a class="nav-link" href="{{route('admin.profile')}}"><i class="fa fa-user"></i>Profile Info</a>
                    @endif
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logOutForm').submit()"><i class="fa fa-power-off"></i>Logout</a>
                    <form action="{{route('logout')}}" method="post" id="logOutForm">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
