<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchStudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\BranchAccountController;
use App\Http\Controllers\BranchPaymentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BillTypeController;
use App\Http\Controllers\StudentPaymentController;
use App\Http\Controllers\StudentBillController;
use App\Http\Controllers\CourseModuleResultController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchApplyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\ExamAttendanceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonialController;

//frontend section

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/branch/apply', [BranchApplyController::class, 'index'])->name('branch.apply');
Route::post('/branch/apply/submit', [BranchApplyController::class, 'submit'])->name('branch.apply.submit');
Route::get('/exam-result', [HomeController::class, 'examResult'])->name('exam.results');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/resources', [HomeController::class, 'resources'])->name('resources');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/branches/all', [HomeController::class, 'branches'])->name('branches.all');

Route::get('/about-us', [HomeController::class, 'about'])->name('about.us');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms-conditions');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');
Route::get('/help', [HomeController::class, 'help'])->name('help');
Route::post('/user/message/send', [UserMessageController::class, 'submit'])->name('user.message.send');

//Route::get('buser', [LoginController::class, 'name'])->name('buser');

Route::post('admin/login', [LoginController::class, 'loginSubmit'])->name('admin.login');
Route::get('admin/not-found', [PageController::class, 'notFound'])->name('admin.notFound');

Route::prefix('/')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::prefix('admin/')->name('admin.')->middleware('branchAdmin')->group(function () {
//    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('notice/list', [NoticeController::class, 'list'])->name('notice.list');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
});
Route::prefix('branch/')->group(function () {
    //branch_student module
    Route::prefix('student/')->name('student.')->middleware('branchAdmin')->group(function () {
        Route::get('add', [BranchStudentController::class, 'add'])->name('add');
        Route::post('submit', [BranchStudentController::class, 'submit'])->name('submit');
        Route::get('list', [BranchStudentController::class, 'list'])->name('list');
        Route::get('filter', [BranchStudentController::class, 'filter'])->name('filter');
        Route::get('student/get/{student_roll}', [BranchStudentController::class, 'getStudentByRoll'])->name('get-student');
//        Route::get('result-sheet', [BranchStudentController::class, 'result'])->name('result');
//        Route::post('result/update', [BranchStudentController::class, 'resultUpdate'])->name('result.update');
        Route::get('registration/card', [BranchStudentController::class, 'getRegCard'])->name('registration.card');
        Route::post('registration/card', [BranchStudentController::class, 'getRegCardSubmit'])->name('registration.card');
        Route::get('registration/print/{id}', [BranchStudentController::class, 'printRegistration'])->name('registration.print');
        Route::get('id-card/print/{id}', [BranchStudentController::class, 'printId'])->name('id.print');
//        Route::get('result-sheet/print', [BranchStudentController::class, 'printResultSheet'])->name('result-sheet.print');
        Route::get('admit/print/{id}', [BranchStudentController::class, 'printAdmit'])->name('admit.print');
//        Route::get('result/print/{id}', [BranchStudentController::class, 'printResult'])->name('result.print');
        Route::get('edit/{id}', [BranchStudentController::class, 'edit'])->name('edit');
        Route::post('update', [BranchStudentController::class, 'update'])->name('update');


//        //course Module Result
//        Route::get('result/module/add/{id}', [CourseModuleResultController::class, 'add'])->name('result.module.add');
//        Route::get('result/module/edit/{id}', [CourseModuleResultController::class, 'edit'])->name('result.module.edit');
//        Route::post('result/module/submit', [CourseModuleResultController::class, 'submit'])->name('result.module.submit');
//        Route::post('result/module/update', [CourseModuleResultController::class, 'update'])->name('result.module.update');

        //student_payment module
        Route::prefix('payment/')->name('payment.')->group(function () {
            Route::get('add', [StudentPaymentController::class, 'add'])->name('add');
            Route::post('submit', [StudentPaymentController::class, 'submit'])->name('submit');
            Route::get('list', [StudentPaymentController::class, 'list'])->name('list');
            Route::get('edit/{id}', [StudentPaymentController::class, 'edit'])->name('edit');
            Route::post('update', [StudentPaymentController::class, 'update'])->name('update');
            Route::post('remove', [StudentPaymentController::class, 'remove'])->name('remove');

        });


        Route::prefix('bills/')->name('bill.')->group(function () {
            Route::get('add', [StudentBillController::class, 'add'])->name('add');
            Route::post('submit', [StudentBillController::class, 'submit'])->name('submit');
            Route::get('list', [StudentBillController::class, 'list'])->name('list');
        });
    });

    //exam attendance Module
    Route::prefix('exam/attendance')->name('exam.attendance.')->middleware('branchAdmin')->group(function () {
        Route::get('add', [ExamAttendanceController::class, 'add'])->name('add');
        Route::post('submit', [ExamAttendanceController::class, 'submit'])->name('submit');
//        Route::get('list', [ExamAttendanceController::class, 'list'])->name('list');
//        Route::get('details/{id}', [ExamAttendanceController::class, 'details'])->name('details');
        Route::get('edit/{id}', [ExamAttendanceController::class, 'edit'])->name('edit');
        Route::post('update', [ExamAttendanceController::class, 'update'])->name('update');
        Route::post('remove', [ExamAttendanceController::class, 'remove'])->name('remove');

    });



    Route::prefix('accounts/')->name('accounts.')->middleware('branchAdmin')->group(function () {
        Route::get('bill-summary', [BranchAccountController::class, 'billSummary'])->name('bill-summary');
        Route::get('payments', [BranchPaymentController::class, 'payment'])->name('payments');
    });

    Route::prefix('notice/')->name('notice.')->middleware('branchAdmin')->group(function () {
        Route::get('list', [NoticeController::class, 'list'])->name('list');
    });
});

Route::middleware('auth')->group(function () {

    Route::prefix('student/')->name('student.')->group(function () {
        Route::get('list', [BranchStudentController::class, 'list'])->name('list');
        Route::post('remove', [BranchStudentController::class, 'remove'])->name('remove');
        Route::get('result-sheet', [BranchStudentController::class, 'result'])->name('result');
        Route::post('result/update', [BranchStudentController::class, 'resultUpdate'])->name('result.update');
        Route::get('result-sheet/print', [BranchStudentController::class, 'printResultSheet'])->name('result-sheet.print');
        Route::get('result/print/{id}', [BranchStudentController::class, 'printResult'])->name('result.print');

        //course Module Result
        Route::get('result/module/add/{id}', [CourseModuleResultController::class, 'add'])->name('result.module.add');
        Route::get('result/module/edit/{id}', [CourseModuleResultController::class, 'edit'])->name('result.module.edit');
        Route::post('result/module/submit', [CourseModuleResultController::class, 'submit'])->name('result.module.submit');
        Route::post('result/module/update', [CourseModuleResultController::class, 'update'])->name('result.module.update');
    });
    //exam attendance
    Route::prefix('exam/attendance/')->name('exam.attendance.')->group(function () {
        Route::get('list', [ExamAttendanceController::class, 'list'])->name('list');
        Route::get('details/{id}', [ExamAttendanceController::class, 'details'])->name('details');
        Route::get('print/{id}', [ExamAttendanceController::class, 'print'])->name('print');
    });
});
//super-admin module
Route::prefix('admin/')->name('admin.')->middleware('admin')->group(function () {

    //exam attendance Module
    Route::prefix('slider/')->name('slider.')->group(function () {
        Route::get('add', [SliderController::class, 'add'])->name('add');
        Route::post('submit', [SliderController::class, 'submit'])->name('submit');
        Route::get('list', [SliderController::class, 'list'])->name('list');
        Route::get('edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::post('update', [SliderController::class, 'update'])->name('update');
        Route::post('remove', [SliderController::class, 'remove'])->name('remove');

    });

    Route::prefix('testimonial/')->name('testimonial.')->group(function () {
        Route::get('add', [TestimonialController::class, 'add'])->name('add');
        Route::post('submit', [TestimonialController::class, 'submit'])->name('submit');
        Route::get('list', [TestimonialController::class, 'list'])->name('list');
        Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::post('update', [TestimonialController::class, 'update'])->name('update');
        Route::post('remove', [TestimonialController::class, 'remove'])->name('remove');

    });

    //        branch-module
    Route::prefix('branch/')->name('branch.')->group(function () {
        Route::get('add', [BranchController::class, 'add'])->name('add');
        Route::get('get-district-by-division/{id}', [BranchController::class, 'getDistrictByDivision'])->name('get-district-by-division');
        Route::get('get-upazila-by-district/{id}', [BranchController::class, 'getUpazilaByDistrict'])->name('get-upazila-by-district');
        Route::post('submit', [BranchController::class, 'submit'])->name('submit');
        Route::get('list', [BranchController::class, 'list'])->name('list');
        Route::get('edit/{id}', [BranchController::class, 'edit'])->name('edit');
        Route::post('update', [BranchController::class, 'update'])->name('update');
        Route::post('remove', [BranchController::class, 'remove'])->name('remove');

        //branch-application
        Route::prefix('applications/')->name('application.')->group(function () {
            Route::get('list', [BranchApplyController::class, 'list'])->name('list');
            Route::get('details/{id}', [BranchApplyController::class, 'details'])->name('details');
            Route::get('approve/{id}', [BranchApplyController::class, 'approve'])->name('approve');
            Route::get('remove', [BranchApplyController::class, 'remove'])->name('remove');
        });

        //branch-account module
        Route::prefix('account/')->name('account.')->group(function () {
            Route::get('add', [BranchAccountController::class, 'add'])->name('add');
            Route::post('submit', [BranchAccountController::class, 'submit'])->name('submit');
            Route::get('list', [BranchAccountController::class, 'list'])->name('list');
            Route::get('edit/{id}', [BranchAccountController::class, 'edit'])->name('edit');
            Route::post('update', [BranchAccountController::class, 'update'])->name('update');
            Route::post('remove', [BranchAccountController::class, 'remove'])->name('remove');

        });

        //branch-payment module
        Route::prefix('payment/')->name('payment.')->group(function () {
            Route::get('add', [BranchPaymentController::class, 'add'])->name('add');
            Route::post('submit', [BranchPaymentController::class, 'submit'])->name('submit');
            Route::get('list', [BranchPaymentController::class, 'list'])->name('list');
            Route::get('billing', [BranchPaymentController::class, 'billing'])->name('billing');
            Route::get('edit/{id}', [BranchPaymentController::class, 'edit'])->name('edit');
            Route::post('update', [BranchPaymentController::class, 'update'])->name('update');
            Route::post('remove', [BranchPaymentController::class, 'remove'])->name('remove');

        });

    });

    //        course-module
    Route::prefix('course/')->name('course.')->group(function () {
        Route::get('add', [CourseController::class, 'add'])->name('add');
        Route::post('submit', [CourseController::class, 'submit'])->name('submit');
        Route::get('list', [CourseController::class, 'list'])->name('list');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('update', [CourseController::class, 'update'])->name('update');
        Route::post('remove', [CourseController::class, 'remove'])->name('remove');
    });

    //        session-module
    Route::prefix('session/')->name('session.')->group(function () {
        Route::get('add', [SessionController::class, 'add'])->name('add');
        Route::post('submit', [SessionController::class, 'submit'])->name('submit');
        Route::get('list', [SessionController::class, 'list'])->name('list');
        Route::get('edit/{id}', [SessionController::class, 'edit'])->name('edit');
        Route::post('update', [SessionController::class, 'update'])->name('update');
        Route::post('remove', [SessionController::class, 'remove'])->name('remove');

    });

    Route::prefix('student/')->name('student.')->group(function () {
        Route::get('certificate/print/{id}', [CertificateController::class, 'printCertificate'])->name('certificate.print');
//        Route::get('list', [BranchStudentController::class, 'list'])->name('list');
//        Route::post('remove', [BranchStudentController::class, 'remove'])->name('remove');
//        Route::get('result-sheet', [BranchStudentController::class, 'result'])->name('result');
//        Route::post('result/update', [BranchStudentController::class, 'resultUpdate'])->name('result.update');
//        Route::get('result-sheet/print', [BranchStudentController::class, 'printResultSheet'])->name('result-sheet.print');
    });

    //gallery-module
    Route::prefix('gallery/')->name('gallery.')->group(function () {
        Route::get('add', [GalleryController::class, 'add'])->name('add');
        Route::post('submit', [GalleryController::class, 'submit'])->name('submit');
        Route::get('list', [GalleryController::class, 'list'])->name('list');
        Route::get('details/{id}', [GalleryController::class, 'details'])->name('details');
        Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('edit');
        Route::post('update', [GalleryController::class, 'update'])->name('update');
        Route::post('remove', [GalleryController::class, 'remove'])->name('remove');

    });

    //message-module
    Route::prefix('message/')->name('message.')->group(function () {
        Route::get('write', [MessageController::class, 'add'])->name('add');
        Route::post('send', [MessageController::class, 'submit'])->name('submit');
        Route::get('list', [MessageController::class, 'list'])->name('list');
        Route::get('edit/{id}', [MessageController::class, 'edit'])->name('edit');
        Route::post('update', [MessageController::class, 'update'])->name('update');
        Route::post('remove', [MessageController::class, 'remove'])->name('remove');

        //user message list
        Route::get('user/list', [UserMessageController::class, 'list'])->name('user.list');

    });

    //        notice-module
    Route::prefix('notice/')->name('notice.')->group(function () {
        Route::get('add', [NoticeController::class, 'add'])->name('add');
        Route::post('submit', [NoticeController::class, 'submit'])->name('submit');
        Route::get('list', [NoticeController::class, 'list'])->name('list');
        Route::get('edit/{id}', [NoticeController::class, 'edit'])->name('edit');
        Route::post('update', [NoticeController::class, 'update'])->name('update');
        Route::post('remove', [NoticeController::class, 'remove'])->name('remove');
    });
    //        bill-type-module
    Route::prefix('bills/type')->name('bills.type.')->group(function () {
        Route::get('add', [BillTypeController::class, 'add'])->name('add');
        Route::post('submit', [BillTypeController::class, 'submit'])->name('submit');
        Route::get('list', [BillTypeController::class, 'list'])->name('list');
        Route::get('edit/{id}', [BillTypeController::class, 'edit'])->name('edit');
        Route::post('update', [BillTypeController::class, 'update'])->name('update');
        Route::post('remove', [BillTypeController::class, 'remove'])->name('remove');
    });

    Route::prefix('setting/')->name('setting.')->group(function () {
        Route::get('list', [SettingController::class, 'list'])->name('list');
        Route::get('edit', [SettingController::class, 'edit'])->name('edit');
        Route::post('update', [SettingController::class, 'update'])->name('update');
    });
});


