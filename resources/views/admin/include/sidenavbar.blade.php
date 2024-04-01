<aside id="left-panel" class="left-panel" style="width: {{Auth::user()->role == 1 ? '22%':'20%'}}">
    <nav class="navbar navbar-expand-sm navbar-default" >
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('admin.dashboard')}}"><i class="menu-icon fa fa-tachometer"></i>Dashboard </a>
                </li>

                @if(Auth::user()->role == 2)
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Student Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('student.add')}}">Add Student</a></li>
                            <li><a href="{{route('student.list')}}">View Students</a></li>
                            <li><a href="{{route('student.result')}}">Result Input</a></li>
                            <li><a href="{{route('student.registration.card')}}">Print Registration</a></li>
{{--                            <li><a href="{{route('student.id.card')}}">Print ID Card</a></li>--}}
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Exam Attendance</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('exam.attendance.add')}}">Add Attendance</a></li>
                            <li><a href="{{route('exam.attendance.list')}}">View Attendance</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti ti-credit-card"></i>Student Account</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('student.bill.add')}}">Add Bill</a></li>
                            <li><a href="{{route('student.bill.list')}}">View Bills</a></li>
                            <li><a href="{{route('student.payment.add')}}">Add Payment</a></li>
                            <li><a href="{{route('student.payment.list')}}">View Payments</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Branch Account</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('accounts.bill-summary')}}">Billing Summary</a></li>
                            <li><a href="{{route('accounts.payments')}}">Payment</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bullhorn"></i>Notice</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('notice.list')}}">View Notice</a></li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->role == 1)
                    <li><hr></li>
                    <li class="menu-title text-center">Admin</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Slider Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.slider.add')}}">Add Slider</a></li>
                            <li><a href="{{route('admin.slider.list')}}">View Slider</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-puzzle-piece"></i>Branch Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.branch.add')}}">Add Branch</a></li>
                            <li><a href="{{route('admin.branch.list')}}">View Branches</a></li>
                            <li><a href="{{route('admin.branch.application.list')}}">Branch Applications</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Student Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('student.list')}}">Print Certificate</a></li>
                            <li><a href="{{route('student.result')}}">Result Input</a></li>
                            <li><a href="{{route('exam.attendance.list')}}">View Exam Attendance</a></li>

                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file-text"></i>Course Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.course.add')}}">Add Course</a></li>
                            <li><a href="{{route('admin.course.list')}}">View Courses</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Teacher Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.teacher.add')}}">Add Teacher</a></li>
                            <li><a href="{{route('admin.teacher.list')}}">View Teacher</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-hourglass-half"></i>Session Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.session.add')}}">Add Session</a></li>
                            <li><a href="{{route('admin.session.list')}}">View Sessions</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-sticky-note"></i>Notice Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.notice.add')}}">Add Notice</a></li>
                            <li><a href="{{route('admin.notice.list')}}">View Notices</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-clipboard"></i>Testimonial Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.testimonial.add')}}">Add Testimonial</a></li>
                            <li><a href="{{route('admin.testimonial.list')}}">View Testimonial</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Finance Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.branch.payment.add')}}">Add Payments</a></li>
                            <li><a href="{{route('admin.branch.payment.billing')}}">Billing</a></li>
                            <li><a href="{{route('admin.branch.payment.list')}}">Payment Report</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Bill Types</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.bills.type.add')}}">Add Bill Types</a></li>
                            <li><a href="{{route('admin.bills.type.list')}}">View Bill Types</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-image"></i>Gallery Images</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.gallery.add')}}">Add Images</a></li>
                            <li><a href="{{route('admin.gallery.list')}}">View Images</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comment"></i>Message Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.message.add')}}">Send Message</a></li>
                            <li><a href="{{route('admin.message.list')}}">View Sent Messages</a></li>
                            <li><a href="{{route('admin.message.user.list')}}">View User Messages</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gear"></i>Settings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="{{route('admin.setting.list')}}">View Settings</a></li>
                            <li><a href="{{route('admin.setting.edit')}}">Edit Settings</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
